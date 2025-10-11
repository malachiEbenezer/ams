<x-filament-panels::page>

  <div class="bg-blue p-6 rounded-lg shadow-lg w-full max-w-2xl mx-auto border-gray-300">
    <h1 class="text-2xl font-bold text-center mb-4">Barcode Scanner</h1>

    <p class="text-sm text-gray-600 mb-6 text-center">
        Kindly scan or type your Panabo Student Center ID to log in.<br>
        If ever you are not yet registered, kindly ask the staff for assistance. Thank you.
    </p>

    <div class="mt-6">
            <div class="text-sm font-medium text-gray-700">ID Code:</div>
            <div class="mt-1 text-gray-500">VPSC-xxxxxxxxxx</div>
        </div>

    <div class="space-y-4">
        @foreach ([
            'Name',
            'Gender',
            'Year Level',
            'Course',
            'School',
            'Date',
            'Time In',
            'Time Out',
            'Number of Visits'
        ] as $label)
            <div class="grid grid-cols-2 gap-4">
                <div class="text-sm font-medium text-gray-700">{{ $label }}:</div>
                <div class="border-b border-gray-300"></div>
            </div>
        @endforeach

        
    </div>
</div>

</x-filament-panels::page>
