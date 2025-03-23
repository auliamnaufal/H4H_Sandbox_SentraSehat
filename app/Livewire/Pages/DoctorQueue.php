<?php

namespace App\Livewire\Pages;

use App\Models\HospitalReferral;
use App\Models\PatientHistory;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DoctorQueue extends Component
{
    public $patientNik, $complaint, $diagnosis, $treatment, $medication, $refer, $healthFacility;
    public $patients;
    public $currentPatient;
    public $medicalRecords;
    public $currentIndex = 0;

    protected $rules = [
        "complaint" => 'required',
        "diagnosis" => 'required',
        "treatment" => 'required',
        "medication" => 'required',
    ];

    public function mount()
    {
        $this->patients = Queue::where("poly_id", Auth::user()->doctor_poly)->get();
        $this->setCurrentPatient();
    }

    public function setCurrentPatient()
    {
        if ($this->patients->isNotEmpty() && isset($this->patients[$this->currentIndex])) {
            $this->currentPatient = $this->patients[$this->currentIndex];
            $this->medicalRecords = $this->currentPatient->patient->history;
        }
    }

    public function nextPatient()
    {
        if ($this->currentIndex < $this->patients->count() - 1) {
            $this->currentIndex++;
            $this->setCurrentPatient();
        }
    }

    public function previousPatient()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
            $this->setCurrentPatient();
        }
    }

    public function submitDiagnosis()
    {
        $this->validate();

        PatientHistory::create([
            "complaint" => $this->complaint,
            "diagnosis" => $this->diagnosis,
            "treatment" => $this->treatment,
            "patient_nik" => $this->currentPatient->patient_nik,
            "health_facility_id" => Auth::user()->health_facility_id,
            "poly_id" => Auth::user()->doctor_poly,
            "doctor_id" => Auth::user()->id,
        ]);

        if ($this->refer) {
            HospitalReferral::create([
                "patient_nik" => $this->currentPatient->patient_nik,
                "health_facility_id" => Auth::user()->health_facility_id,
                "poly_id" => Auth::user()->doctor_poly,
                "doctor_id" => Auth::user()->id,
                "target_health_facility_id" => $this->healthFacility,
                "target_poly_id" => $this->polyId,
            ]);
        }

        session()->flash('message', 'Diagnosis submitted successfully.');
        $this->resetExcept(['patients', 'currentIndex']);
        $this->setCurrentPatient();
    }
}
