Welkom bij de applicatie voor busbedrijf ToetToet!

Setup guide:

1. Download de zip file!
2. Pak de zip file uit en open de folder met je gekozen IDE.
3. Run de composer.json (in phpStorm krijg je hier een prompt voor), anders in de terminal run 'composer update' en dan 'composer install'
4. Run 'npm install' in de terminal
5. Kopieer de .env.example file en verwijder de .example ervan dat je alleen nog .env hebt staan.
6. Zet hier vervolgens je eigen database gegevens in zodat je hem kan koppelen
7. Run 'php artisan key:generate' in je terminal.
8. Run 'php artisan migrate:fresh --seed' in je terminal om de database op te vullen met de nodige tabellen en data
9. Vanaf hier kan je twee kanten op. Als je de applicatie wilt runnen zonder te testen run 'php artisan serve' in je terminal en het is ready voor gebruik. Om in te loggen als employee gebruik je username 'employee@test.com' en wachtwoord 'Standaard' | voor een medewerker gebruik je username 'bart@test.com' met wachtwoord 'Standaard'.
10. Om te testen sla je stap 9 over en run je 'php artisan test' in je terminal. De testen worden uitgevoerd.
11. Als de testen klaar zijn herhaal je stap 8 om de database weer te vullen en doe je stap 9 om de applicatie te kunnen gebruiken.

Veel plezier met het gebruik :)
