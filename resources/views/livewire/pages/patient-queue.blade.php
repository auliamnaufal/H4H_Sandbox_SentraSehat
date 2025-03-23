<div class="flex flex-col items-start">
    <x-pages.layout :heading="__('Antrian Pasien')" :subheading=" __('')">
        <form wire:submit="addPatientToQueue" class="my-6 w-full space-y-4 py-4 px-6 border-1 border-gray-500 rounded-lg">

            <flux:input wire:model="nik" :label="__('NIK')" type="number" required autofocus />
            <flux:input wire:model="name" :label="__('Nama Lengkap')" type="text" required autocomplete="name" />

            <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                <flux:select label="Jenis Kelamin" wire:model="gender">
                    <option value="male">Laki-Laki</option>
                    <option value="female">Perempuan</option>
                </flux:select>
                <flux:select label="Golongan Darah" wire:model="bloodType">
                    <option value="-">-</option>
                    <option value="o">O</option>
                    <option value="b">B</option>
                    <option value="ab">AB</option>
                </flux:select>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                <flux:input label="Tempat Lahir" wire:model="placeOfBirth" />
                <flux:input label="Tanggal Lahir" type="date" wire:model="bod" />
            </div>

            <flux:legend>Domisili</flux:legend>

            <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                <flux:input wire:model="province" :label="__('Provinsi')" type="text" />
                <flux:input wire:model="city" :label="__('Kota')" type="text" />
            </div>
            <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                <flux:input wire:model="subdistrict" :label="__('Kecamatan')" type="text" />
                <flux:input wire:model="village" :label="__('Kelurahan/Desa')" type="text" />
            </div>

            <flux:textarea wire:model="address" :label="__('Alamat')" type="text" />
            <flux:select label="Poli" wire:model="polyId">
                    <option value="1">Umum</option>
                    <option value="2">THT</option>
                </flux:select>


            <div class="flex items-center justify-end gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Masukan') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:queue-table theme="tailwind" />
    </x-pages.layout>
</div>
