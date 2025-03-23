<div class="flex flex-col items-start">
  <x-pages.layout :heading="__('Antrian Pasien')" :subheading="__('')">
    <div class="my-6 w-full space-y-4 py-4 px-6 border-1 border-gray-500 rounded-lg">
      @if ($currentPatient)
        <div class="grid grid-cols-4 gap-x-12">
          <form wire:submit.prevent="submitDiagnosis" class="col-span-1">
            <flux:textarea wire:model="complaint" :label="__('Keluhan')" required />
            <flux:textarea wire:model="diagnosis" :label="__('Diagnosis')" required />
            <flux:textarea wire:model="treatment" :label="__('Pengobatan')" required />
            <flux:input wire:model="medication" :label="__('Obat')" type="text" required />

            <!-- Referral Section -->
            <div class="mb-4">
              {{-- <flux:toggle wire:model="refer" label="Rujuk ke rumah sakit lain" /> --}}
              @if ($refer)
                <flux:select wire:model="healthFacility" label="Fasilitas Kesehatan Tujuan">
                  <option value="">-- Pilih --</option>
                  <option value="1">Rumah Sakit A</option>
                  <option value="2">Rumah Sakit B</option>
                </flux:select>
              @endif
            </div>

            <flux:button variant="primary" type="submit">
              Kirim Diagnosis
            </flux:button>
          </form>
          <div class="col-span-3">
            <div class="my-6 w-full p-6 border border-gray-300 rounded-lg bg-zinc-700">
              <!-- Personal Information -->
              <div class="grid grid-cols-2 gap-4 border-b pb-4 mb-4">
                <div>
                  <p class="text-gray-500">Nama Lengkap</p>
                  <p class="font-semibold">{{ $currentPatient->patient->name ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-gray-500">NIK</p>
                  <p class="font-semibold">{{ $currentPatient->patient_nik ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-gray-500">Gol Darah</p>
                  <p class="font-semibold">{{ $currentPatient->patient->blood_type ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-gray-500">Tanggal Lahir</p>
                  <p class="font-semibold">{{ \Carbon\Carbon::parse($currentPatient->patient->dob) ?? '-' }}</p>
                </div>
              </div>

              <!-- Medical History -->
              <h3 class="text-lg font-semibold mb-4">Riwayat Penyakit</h3>
              @if ($medicalRecords->isNotEmpty())
                @foreach ($medicalRecords as $record)
                  <div class="border-t pt-4 mb-4">
                    <p class="font-semibold">
                      {{ $record->created_at->diffForHumans() }} • Dr. {{ $record->doctor->name }} • {{ $record->healthFacility->name }}
                    </p>
                    <p class="text-gray-50 mt-2">Keluhan</p>
                    <p class="text-gray-200 text-xs">{{ $record->complaint }}</p>
                    <p class="text-gray-50 mt-2">Diagnosis</p>
                    <p class="text-gray-200 text-xs">{{ $record->diagnosis }}</p>
                    <p class="text-gray-50 mt-2">Treatment</p>
                    <p class="text-gray-200 text-xs">{{ $record->treatment }}</p>
                    <p class="text-gray-50 mt-2">Obat</p>
                    <p class="text-gray-200 text-xs">{{ $record->medicine }}</p>
                  </div>
                @endforeach
              @else
                <p class="text-gray-500">Tidak ada riwayat medis sebelumnya.</p>
              @endif
            </div>
          </div>
        </div>
        <!-- Diagnosis Form -->
      @else
        <p class="text-gray-500">Tidak ada pasien dalam antrean.</p>
      @endif
    </div>

    <div class="flex justify-between mt-6">
      <flux:button wire:click="previousPatient" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md">
        Pasien Sebelumnya
      </flux:button>
      <flux:button wire:click="nextPatient" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md">
        Pasien Berikutnya
      </flux:button>
    </div>

    {{-- <livewire:queue-table theme="tailwind" /> --}}
  </x-pages.layout>
</div>
