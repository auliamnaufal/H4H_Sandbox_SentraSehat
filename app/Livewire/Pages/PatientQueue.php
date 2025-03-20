<?php

namespace App\Livewire\Pages;

use App\Models\Queue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PatientQueue extends Component
{
    use WithPagination;

    public $nik, $name, $gender, $placeOfBirth, $bod, $bloodType, $province, $city, $subdistrict, $village, $address, $polyId;
    public $search = '';

    protected $rules = [
        "nik" => 'required',
        "name" => 'required',
        "gender" => 'required',
        "bloodType" => 'required',
        "province" => 'required',
        "city" => 'required',
        "subdistrict" => 'required',
        "village" => 'required',
        "address" => 'required',
        "polyId" => 'required',
    ];

    public function addPatientToQueue()
    {
        $this->validate();

        $patient = User::where("nik", $this->nik)->first();

        if ($patient == null) {
            $patient = User::create([
                "nik" => $this->nik,
                "bod" => $this->bod,
                "name" => $this->name,
                "password" => "12345",
            ]);
        }

        Queue::create([
            "patient_nik" => $this->nik,
            "health_facility_id" => Auth::user()->health_facility_id,
            "poly_id" => $this->polyId,
            "doctor_id" => null,
        ]);

        session()->flash('message', 'Patient registered successfully.');
        $this->reset();
    }

    public function render()
    {
        $queue = Queue::paginate(10);
        return view('livewire.pages.patient-queue', compact('queue'));
    }
}
