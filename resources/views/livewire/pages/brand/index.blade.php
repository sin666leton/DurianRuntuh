<x-container>
    <x-breadcrumb :links="[
        'Beranda' => '/home',
        'Merk' => '#'
    ]"/>
    <x-header title="Manajemen Merk" />
    <div class="flex flex-col gap-8">
        <!-- Form -->
        <livewire:components.form-create-brand/>
        <!-- Table -->
        <livewire:components.table-brand/>
    </div>
</x-container>