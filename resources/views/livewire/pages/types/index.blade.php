<x-container>
    <x-breadcrumb :links="[
        'Beranda' => '/home',
        'Master Tipe & Items' => '#'
    ]"/>
    <x-header title="Master Tipe & Items" />
    <div class="flex flex-col gap-8">
        <!-- Form -->
        <livewire:components.form-create-type/>
        <!-- Table -->
        <livewire:components.table-type/>
    </div>
</x-container>