<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Category;
use App\Models\Style;

new class extends Component
{
    public $categories = [];
    public $stylesCount = 0;
    public $userStyles = [];
    public $userMedals = [];
    public $user;
    public $filtered = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->user = \Auth::user();
        $this->setCategories();
        $this->stylesCount = Style::count();
        $this->userMedals = $this->user->medals()->pluck('style_id', 'place');
    }

    public function updatedFiltered() : void
    {
        $this->setCategories($this->filtered);
    }

    public function updated($property)
    {
        if (strstr($property, 'userStyles') !== false) {
            if($this->filtered) {
                $this->user->styles()->syncWithoutDetaching($this->userStyles);
            } else {
                $this->user->styles()->sync($this->userStyles);
            }
            $this->setCategories($this->filtered);
            $this->dispatch('styles-updated');
        }
    }

    public function save() : void
    {
        $this->updated('userStyles');
    }

    protected function setCategories($filtered = false) {
        if($filtered) {
            $this->categories = Category::orderedMissingWithStyles($this->user->id)->get();
            $this->userStyles = [];
        } else {
            $this->categories = Category::orderedWithStyles()->get();
            $this->userStyles = $this->user->styles()->pluck('style_id');
        }
    }
}; ?>

<div class="p-6">
    @if($filtered)
    <x-secondary-button class="float-right" wire:click="$set('filtered', false)">Mostrar todos</x-secondary-button>
    @else
    <x-secondary-button class="float-right" wire:click="$set('filtered', true)">Filtrar faltantes</x-secondary-button>
    @endif

    <form wire:submit="save">
        <table class="border-collapse w-full">
            <tbody>
                @foreach($categories as $category)
                @if($category->styles->count() > 0)
                <tr class="border-b border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <td colspan="2" class="text-3xl p-2">{{ $category->id }}.{{ $category->name }}</td>
                </tr>
                @foreach($category->styles as $style)
                <tr class="border-b border-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700">
                    <td class="pl-10 p-2">
                        {{ $style->code }}. {{ $style->name }}
                    </td>
                    <td class=" text-right pr-2">
                        <input type="checkbox" wire:model.change="userStyles" name="style[]" value="{{ $style->id }}" class="rounded text-gray-500 h-6 w-6" />
                    </td>
                </tr>
                @endforeach
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="pt-4 pb-4 pl-2 pr-2">
                        <div class="text-3xl float-left">Total:</div>
                        <div class="float-right">
                            {{ $stylesCount }} / <span class="text-2xl">{{ count($userStyles) }}</span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>

        <x-primary-button type="submit">Salvar</x-button>

        <x-toaster-message class="me-3" on="styles-updated">
            Estilo salvo!
        </x-toaster-message>
    </form>
</div>
