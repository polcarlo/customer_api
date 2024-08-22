<?php

namespace App\Services;
use App\Models\Customer; 
use Illuminate\Support\Facades\Http;

class RandomUserImporter implements ImporterInterface
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.randomuser.url', 'https://randomuser.me/api/');
    }

    public function importCustomers()
{
    $response = Http::get($this->apiUrl, [
        'results' => 100,
        'nat' => 'AU',
    ]);

    $customers = $response->json()['results'];

    foreach ($customers as $customerData) {
        try {
            $customer = Customer::updateOrCreate(
                ['email' => $customerData['email']],
                [
                    'first_name' => $customerData['name']['first'],
                    'last_name' => $customerData['name']['last'],
                    'username' => $customerData['login']['username'],
                    'gender' => $customerData['gender'],
                    'country' => $customerData['location']['country'],
                    'city' => $customerData['location']['city'],
                    'phone' => $customerData['phone'],
                    'password' => md5($customerData['login']['password']),
                ]
            );


          
        } catch (\Exception $e) {
           
        }
    }
}

}
