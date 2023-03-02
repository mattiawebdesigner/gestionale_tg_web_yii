<p align="center">
    <a href="https://www.teatralmentegioia.it/crm/" target="_blank">
        <img src="https://www.teatralmentegioia.it/tg/wp-content/uploads/2021/08/logo.png" height="100px">
    </a>
    <h1 align="center">CRM (Customer relationship management) Teatralmente Gioia</h1>
    <br>
</p>

Questo progetto serve per gestire i soci.
I soci hanno la loro area riservata nella quale possono visualizzare i bilanci e i verbali della compagnia teatrale.

Il CRM è anche utilizzato per amministrare, tramite un unico portale, anche i futuri progetti, come quello di **I Love Teatro**.

STRUTTURA DELLE DIRECTORY
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
