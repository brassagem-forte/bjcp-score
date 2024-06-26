# Brassagem Forte BJCP Score

Just another simple app to our beloved supporters.

## About BJCP Score

Somewhere back in time, Henrique Boaventura (@kidh0) thought it was a good idea to start a competition with Estevão Chittó to decide which one of them would finish first to brew all the BJCP styles. Bad, very bad idea.

It grew up to the point of many people willing to do the same and now I built a system to simplify.

We make weekly reports on our podcast [Brassagem Forte](http://www.brassagemforte.com.br)

## Tech Stack

- PHP 8.3
- Laravel 11
- TailwindCSS (it was on laravel package, why not?)
- Livewire
- MariaDB (a.k.a. MySQL)

## How to run

- Ok, clone the repo
- From the root dir:
  - Install the required libs:
    - `composer install`
    - `npm install && npm run dev`
  - Copy .env file
    - `cp .env.example .env`
  - Generate API Key
    - `php artisan key:generate`
- Database things:
  - `touch datatabase/database.sqlite`
  - `php artisan db:seed --class=Styles`
- Run Forrest, run:
  - `php artisan serve`

## Testing

- I don't have enough time to make tests. Dammit it is a pretty simple app, it is not a Tesla Car.

## Contributing

Do what ever you want, read the Code of Conduct and make a PR.

## Code of Conduct

Don't fuck the code.

## Security Vulnerabilities

I really don't know if I care. There isn't too much information to leak here.

## License

The BJCP Score is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
