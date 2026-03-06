<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <span class="bg-indigo-600 text-white p-2 rounded-md mr-3">🛍️</span>
        እቃ ይሽጡ (Sell an Item)
    </h2>

    <form wire:submit.prevent="save" class="space-y-6">
        
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition">
            <input type="file" wire:model="photos" multiple class="hidden" id="photo-upload">
            <label for="photo-upload" class="cursor-pointer">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Open Photo Gallery" />
                    </svg>
                    <p class="mt-2 text-sm font-semibold">ፎቶ ይጨምሩ (Add Photos)</p>
                    <p class="text-xs text-gray-400">Up to 3 photos allowed</p>
                </div>
            </label>
            
            @if ($photos)
                <div class="flex flex-wrap gap-2 mt-4 justify-center">
                    @foreach ($photos as $photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-md border shadow-sm">
                    @endforeach
                </div>
            @endif
            @error('photos.*') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">የእቃው ስም (Item Title)</label>
            <input type="text" wire:model="title" placeholder="e.g. iPhone 13 Pro Max" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50">
            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ምድብ (Category)</label>
            <select wire:model="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 bg-gray-50">
                <option value="">ምድብ ይምረጡ (Select Category)</option>
                <option value="Electronics">ኤሌክትሮኒክስ (Electronics)</option>
                <option value="Vehicles">ተሽከርካሪ (Vehicles)</option>
                <option value="Furniture">የቤት ዕቃ (Furniture)</option>
                <option value="Clothing">ልብስ (Clothing)</option>
                <option value="Phones">ስልክ (Phones)</option>
                <option value="Computers">ኮምፒውተር (Computers)</option>
                <option value="Books">መጽሐፍ (Books)</option>
                <option value="Sports">ስፖርት (Sports)</option>
                <option value="Home Appliances">የቤት መገልገያ (Home Appliances)</option>
                <option value="Other">ሌላ (Other)</option>
            </select>
            @error('category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">ዋጋ (Price in ETB)</label>
                <input type="number" wire:model="price" placeholder="10,000" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">ሁኔታ (Condition)</label>
                <select wire:model="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 bg-gray-50">
                    <option value="">Select...</option>
                    <option value="New">አዲስ (New)</option>
                    <option value="Used">ጥቂት ያገለገለ (Used)</option>
                    <option value="Bonda">ቦንዳ (Bonda)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ሰፈር (Location in Dire Dawa)</label>
            <select wire:model="neighborhood" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 bg-gray-50">
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
            <label class="block text-sm font-medium text-gray-700">ዝርዝር መግለጫ (Description)</label>
            <textarea wire:model="description" rows="3" placeholder="Tell buyers more about the item..."
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ስልክ ቁጥር (Phone Number)</label>
            <input type="text" wire:model="phone_number" placeholder="09..." 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3 bg-gray-50">
        </div>

        <button type="submit" 
                class="w-full bg-indigo-600 text-white font-bold py-4 px-4 rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300 transform active:scale-95">
            <span wire:loading.remove>ለሽያጭ አውጣ (Post Now)</span>
            <span wire:loading>በመጫን ላይ... (Wait...)</span>
        </button>
    </form>
</div>