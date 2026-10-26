# NegozioSmart

## Configurazione

Copia `.env.example` in `.env` e configura un utente MySQL dedicato con una password nuova e univoca. Non pubblicare `.env` e impedisci al web server di servire i file nascosti.

## Credenziale precedentemente pubblicata

La vecchia password va revocata sul database e ovunque fosse riutilizzata. La rimozione del file dal branch non elimina le copie nella cronologia Git: dopo la rotazione, pianificare la bonifica della cronologia e dei cloni con chi collabora al repository.
