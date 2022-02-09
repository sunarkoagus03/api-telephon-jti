<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListTelephone;
use App\Models\TeleProvider;
use App\Events\ListTelephoneEvent;

class ListTelephoneController extends Controller
{
    // read
    public function index(Request $request)
    {
        $list_telephone = new ListTelephone();

        if ($request->is_odd == 1) {
            $list_telephone = $list_telephone->with("provider")->where('is_odd', 1)->get();
        } else {
            $list_telephone = $list_telephone->with("provider")->where('is_odd', 0)->get();
        }

        $data = [
            "is_odd" => $request->is_odd,
            "list_telephone" => $list_telephone
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Success Get List Telephone',
            'data' => $data
        ]);
    }

    // detail
    public function detail($id)
    {
        $list_telephone = ListTelephone::with("provider")->find($id);

        if (!$list_telephone) {
            return response()->json([
                'status' => 'error',
                'message' => 'List Telephone Not Found',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success Get List Telephone',
            'data' => $list_telephone
        ]);
    }

    // create
    public function create(Request $request)
    {
        $this->validate($request, [
            'id_tele_provider' => 'required',
            'phone' => 'required',
        ]);

        $data = $this->decrypt_request($request->all());
        
        $data->is_odd = ($data->phone % 2 == 0) ? 0 : 1;

        $phone = ListTelephone::create([
            'id_tele_provider' => $data->id_tele_provider,
            'phone' => $data->phone,
            'is_odd' => $data->is_odd,
        ]);

        $message = "Data telah ditambahkan";
        \event(new ListTelephoneEvent($message));

        return response()->json([
            'status' => 'success',
            'message' => 'Success Create List Telephone',
            'data' => $phone
        ]);
    }

    // update
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id_tele_provider' => 'required',
            'phone' => 'required',
        ]);

        $data = $this->decrypt_request($request->all());

        $data->is_odd = ($data->phone % 2 == 0) ? 0 : 1;

        try {
            $list_telephone = ListTelephone::findOrFail($id);
            $list_telephone->update([
                'id_tele_provider' => $data->id_tele_provider,
                'phone' => $data->phone,
                'is_odd' => $data->is_odd,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data telah diubah',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    // delete
    public function delete($id)
    {
        try {
            $list_telephone = ListTelephone::findOrFail($id);
            $list_telephone->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data telah dihapus',
                'data' => null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }

    // auto generate
    public function generate()
    {
        $data = [
            "phone" => $this->generate_phone(),
            "id_tele_provider" => $this->generate_provider()
        ];
		
        return response()->json([
            'status' => 'success',
            'message' => 'Success Generate Auto',
            'data' => $data
        ]);
    }

    // decrypt request
    private function decrypt_request($request)
    {
        $secret = 'ds8am3wys3pd75nf0ggtvajw2k3uny92';
        $iv = 'jm8lgqa3j1d0ajus';

        $id_tele_provider = openssl_decrypt($request['id_tele_provider'], 'AES-256-CBC', $secret, 0, $iv);
        $phone = openssl_decrypt($request['phone'], 'AES-256-CBC', $secret, 0, $iv);

        return (object) [
            "id_tele_provider" => $id_tele_provider,
            "phone" => $phone,
        ];
    }

    // generate phone number
    private function generate_phone()
    {
        $last =-1; 
        $phone = '';
        for ($i=0;$i<12;$i++)
        {
            do {
                $next_digit=mt_rand(0,9);
            }
            while ($next_digit == $last);
            $last=$next_digit;
            $phone.=$next_digit;
        }

        return $phone;
    }

    // generate id provider
    private function generate_provider()
    {
        $provider = TeleProvider::all();
        $provider_count = $provider->count();
        $provider_random = mt_rand(0, $provider_count - 1);

        return $provider[$provider_random]->id;
    }
}
