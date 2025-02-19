# SENSET Project

Tento projekt je Single Page Application (SPA) postavená na Laravel backend a Vue.js frontend, ktorá spracováva údaje z externého API a zobrazuje ich vo forme koláčového grafu a tabuľky. Projekt obsahuje aj funkcionalitu pre filtrovanie zákazníkov podľa dátumu narodenia a možnosť vymazania záznamov.

## Obsah projektu

- **Laravel backend:**
    - Migrácia pre tabuľku `customers` (stĺpce: id, name, email, dob)
    - Artisan Command pre načítanie údajov z [dummyjson.com/users](https://dummyjson.com/users) a uloženie do databázy
    - API endpointy pre zákazníkov:
        - `GET /api/customers` – zoznam zákazníkov
        - `GET /api/customers/{id}` – detail zákazníka
        - `DELETE /api/customers/{id}` – vymazanie zákazníka

- **Vue.js SPA:**
    - Zobrazenie koláčového grafu (vue-chartjs) s distribúciou zákazníkov podľa mesiaca narodenia
    - Responzívna tabuľka zákazníkov s možnosťou filtrovania podľa dátumu narodenia a vymazania záznamu
    - Rozdelenie kódu do viacerých komponentov:
        - `CustomersFilters.vue`
        - `CustomersChart.vue`
        - `TableRow.vue`
        - `CustomersTable.vue`
        - `CustomersPage.vue`

## Inštalácia a spustenie

1. **Klónovanie repozitára:**

   ```bash
   git clone https://github.com/peter-vavra/senset-project.git
   cd senset-project
