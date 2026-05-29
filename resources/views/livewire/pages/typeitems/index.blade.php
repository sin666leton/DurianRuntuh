<x-container>
    <x-breadcrumb :links="[
        'Beranda' => '/home',
        'Jenis Barang' => '#'
    ]"/>
    <x-header title="Manajemen Jenis Barang" />
    <div class="flex flex-col gap-8">
        <!-- Form -->
        <livewire:components.form-create-type-item/>
        <!-- Table -->
        <livewire:components.table-type-item/>
    </div>
</x-container>