<?php

namespace App\Livewire\Pages;

use App\Models\Queue;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        if (empty($this->nik)) {
            session()->flash('error', 'NIK is required.');
            return;
        }

        // Cast $this->nik to an integer
        $nik = (int)$this->nik;

        $patient = User::where("nik", $nik)->first();

        if ($patient == null) {
            $patient = User::factory()->create([
                "bod" => $this->bod,
                "name" => $this->name,
                "email" => null,
                "nik" => $nik, // Cast to integer
            ]);

            $userRole = Role::where('role', 'patient')->first();

            $patient->roles()->attach($userRole);
        }

        Queue::create([
            "patient_nik" => $nik, // Cast to integer
            "health_facility_id" => Auth::user()->health_facility_id,
            "poly_id" => $this->polyId,
            "doctor_id" => null,
        ]);

        $this->dispatch('refreshDatatable');
        session()->flash('message', 'Patient registered successfully.');
        $this->reset();
    }

    public function render()
    {
        $queue = Queue::paginate(10);
        return view('livewire.pages.patient-queue', compact('queue'));
    }
}
