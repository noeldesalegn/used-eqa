<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white dark:bg-gray-800 shadow-md dark:shadow-gray-900/50 rounded-lg mt-10 transition-colors duration-300">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 flex items-center">
        <span class="bg-indigo-600 text-white p-2 rounded-md mr-3">✏️</span>
        እቃ ያስተካክሉ (Edit Item)
    </h2>

    <form wire:submit.prevent="save" class="space-y-6">

        {{-- Existing Images --}}
        @if(count($existingImages) > 0)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ያሉ ፎቶዎች (Current Photos)</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($existingImages as $index => $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image) }}" class="w-24 h-24 object-cover rounded-lg border dark:border-gray-600 shadow-sm">
                            <button type="button" wire:click="removeExistingImage({{ $index }})"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow hover:bg-red-600 opacity-0 group-hover:opacity-100 transition">
                                ✕
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Add More Photos --}}
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-indigo-500 dark:hover:border-indigo-400 transition">
            <input type="file" wire:model="photos" multiple class="hidden" id="photo-upload">
            <label for="photo-upload" class="cursor-pointer">
                <div class="text-gray-500 dark:text-gray-400">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <p class="mt-2 text-sm font-semibold">ተጨማሪ ፎቶ ይጨምሩ (Add More Photos)</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Up to 3 photos total</p>
                </div>
            </label>

            @if ($photos)
                <div class="flex flex-wrap gap-2 mt-4 justify-center">
                    @foreach ($photos as $photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-md border dark:border-gray-600 shadow-sm">
                    @endforeach
                </div>
            @endif
            @error('photos.*') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">የእቃው ስም (Item Title)</label>
            <input type="text" wire:model="title" placeholder="e.g. iPhone 13 Pro Max"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            @error('title') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ዋጋ (Price in ETB)</label>
                <input type="number" wire:model="price" placeholder="10,000"
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                @error('price') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ሁኔታ (Condition)</label>
                <select wire:model="condition" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                    <option value="">Select...</option>
                    <option value="New">አዲስ (New)</option>
                    <option value="Used">ጥቂት ያገለገለ (Used)</option>
                    <option value="Bonda">ቦንዳ (Bonda)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ሰፈር (Location in Dire Dawa)</label>
            <select wire:model="neighborhood" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                <option value="">ሰፈር ይምረጡ (Select Neighborhood)</option>
                <option value="Kezira">Kezira (ገዚራ)</option>
                <option value="Megala">Megala (መገላ)</option>
                <option value="Taiwan">Taiwan (ታይዋን)</option>
                <option value="Sabiyan">Sabiyan (ሳቢያን)</option>
                <option value="Gende Depo">Gende Depo (ገንደ ዴፖ)</option>
                <option value="01">01 Area</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ዝርዝር መግለጫ (Description)</label>
            <textarea wire:model="description" rows="3" placeholder="Tell buyers more about the item..."
                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ስልክ ቁጥር (Phone Number)</label>
            <input type="text" wire:model="phone_number" placeholder="09..."
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="flex-1 bg-indigo-600 text-white font-bold py-4 px-4 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300 transform active:scale-95">
                <span wire:loading.remove>ያስተካክሉ (Update)</span>
                <span wire:loading>በመጫን ላይ... (Wait...)</span>
            </button>
            <a href="{{ route('listing.mine') }}" wire:navigate
               class="px-6 py-4 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center">
                ሰርዝ (Cancel)
            </a>
        </div>
    </form>
</div>
