<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Customer;

class FetchCustomers extends Command
{
    protected $signature = 'app:fetch-customers';
    protected $description = 'načitávanie zákazníkov z API a ich následné uloženie do databázy';

    public function handle()
    {
        $response = Http::get('https://dummyjson.com/users');
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['users']) && is_array($data['users'])){
                foreach ($data['users'] as $userData) {
                    $email = $userData['email'] ?? null;
                    $name = $userData['firstName'] . ' ' . $userData['lastName'];
                    $dob = isset($userData['birthDate']) ? date('Y-m-d', strtotime($userData['birthDate'])) : null;
                    if ($email && $dob){
                        Customer::updateOrCreate(['email' => $email], ['name' => $name, 'dob' => $dob]);
                    }
                }
                $this->info('zákazníci boli uspešné vložení');
            } else{
                $this->error('nenašiel sa zoznam zákazníkov');
            }
        } else {
            $this->error('chyba pri načítaní dát z API');
        }
    }
}
