<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    protected $model = Listing::class;

    private static array $sampleListings = [
        ['title' => 'Samsung Galaxy S23 Ultra', 'category' => 'Electronics', 'description' => 'Gently used Samsung Galaxy S23 Ultra 256GB. Screen is in perfect condition, no scratches. Comes with original charger and box. Battery health is excellent.'],
        ['title' => 'iPhone 14 Pro Max', 'category' => 'Electronics', 'description' => 'iPhone 14 Pro Max 128GB, Deep Purple. Minor cosmetic wear on the back. Face ID and all cameras work perfectly. Includes a free case.'],
        ['title' => 'Dell Inspiron 15 Laptop', 'category' => 'Electronics', 'description' => 'Dell Inspiron 15 laptop, Intel Core i5, 8GB RAM, 256GB SSD. Great for students. Battery lasts about 5 hours. Keyboard and trackpad in great shape.'],
        ['title' => 'Sony WH-1000XM4 Headphones', 'category' => 'Electronics', 'description' => 'Sony noise-cancelling headphones. Sound quality is amazing, ANC works perfectly. Comes with carrying case and charging cable. Used for 6 months.'],
        ['title' => 'HP LaserJet Pro Printer', 'category' => 'Electronics', 'description' => 'HP LaserJet Pro M404n printer. Prints beautifully, low page count. Includes a half-full toner cartridge. Perfect for home office use.'],
        ['title' => 'Wooden Dining Table Set', 'category' => 'Furniture', 'description' => 'Solid wood dining table with 6 chairs. Some minor scratches on the table surface but overall in great condition. Very sturdy and heavy.'],
        ['title' => 'L-Shaped Office Desk', 'category' => 'Furniture', 'description' => 'Modern L-shaped desk, perfect for home office or gaming setup. Dark walnut finish. Easy to disassemble for transport. Bought new 1 year ago.'],
        ['title' => 'Queen Size Bed Frame', 'category' => 'Furniture', 'description' => 'Metal queen size bed frame with wooden slats. No mattress included. Very sturdy, no squeaking. Easy assembly with included hardware.'],
        ['title' => 'Leather Sofa (3-Seater)', 'category' => 'Furniture', 'description' => 'Brown genuine leather 3-seater sofa. Very comfortable with good cushion support. Minor wear on armrests. Non-smoking household.'],
        ['title' => 'Bookshelf — 5 Tier', 'category' => 'Furniture', 'description' => 'Tall 5-tier wooden bookshelf. Great for books, decor, or storage. Stable and well-made. Slight sun fading on one side.'],
        ['title' => 'Men\'s Leather Jacket (L)', 'category' => 'Clothing', 'description' => 'Genuine leather jacket, size Large. Black color, classic biker style. Worn a few times, still looks brand new. Very warm and stylish.'],
        ['title' => 'Nike Air Max 270 (Size 42)', 'category' => 'Clothing', 'description' => 'Nike Air Max 270, size 42/EU. White and black colorway. Worn a handful of times, soles are clean. Comes with original box.'],
        ['title' => 'Women\'s Traditional Dress (Habesha Kemis)', 'category' => 'Clothing', 'description' => 'Beautiful handwoven Habesha Kemis with colorful tibeb. Worn once for a wedding. Size Medium. Includes matching netela.'],
        ['title' => 'Toyota Corolla 2015 Spare Parts', 'category' => 'Vehicles', 'description' => 'Assorted spare parts for 2015 Toyota Corolla: side mirrors, tail lights, and brake pads. All genuine parts in good condition. Selling as a bundle.'],
        ['title' => 'Bajaj RE 3-Wheeler (Bajaj)', 'category' => 'Vehicles', 'description' => 'Well-maintained Bajaj RE three-wheeler, 2019 model. Low mileage, engine runs smoothly. Ideal for business use. All papers are up to date.'],
        ['title' => 'Mountain Bike (26 inch)', 'category' => 'Vehicles', 'description' => '26-inch mountain bike with 21-speed gears. New tires and brakes recently replaced. Frame is in good condition with minor paint chips.'],
        ['title' => 'Calculus Textbook (Stewart, 8th Ed)', 'category' => 'Books', 'description' => 'Calculus: Early Transcendentals by James Stewart, 8th Edition. Some highlighting inside but pages are clean. Great for university students.'],
        ['title' => 'English-Amharic Dictionary', 'category' => 'Books', 'description' => 'Comprehensive English-Amharic dictionary, hardcover. Over 50,000 entries. Spine is intact, pages are clean. Essential reference book.'],
        ['title' => 'Stainless Steel Cookware Set', 'category' => 'Home & Kitchen', 'description' => '10-piece stainless steel cookware set. Includes pots, pans, and lids. Used but well-maintained, no dents or scratches. Works on all stove types.'],
        ['title' => 'Nespresso Coffee Machine', 'category' => 'Home & Kitchen', 'description' => 'Nespresso Essenza Mini coffee machine, black. Makes perfect espresso every time. Includes 20 free capsules. Descaled and cleaned.'],
        ['title' => 'Portable Generator 2.5KVA', 'category' => 'Electronics', 'description' => '2.5KVA portable petrol generator. Starts on first pull, runs quietly. Perfect for power outages. Recently serviced with new spark plug.'],
        ['title' => 'Children\'s Bicycle (Age 5-8)', 'category' => 'Vehicles', 'description' => 'Kids bicycle suitable for ages 5 to 8. Bright red color with training wheels (removable). Tires and brakes are in good condition.'],
        ['title' => 'Standing Fan (Industrial)', 'category' => 'Home & Kitchen', 'description' => 'Large industrial standing fan with 3 speed settings. Very powerful airflow, perfect for Dire Dawa heat. Oscillates smoothly.'],
        ['title' => 'Samsung 40" Smart TV', 'category' => 'Electronics', 'description' => 'Samsung 40-inch Full HD Smart TV. WiFi built-in, YouTube and Netflix apps work great. Remote included. Wall mount bracket available.'],
        ['title' => 'Gym Dumbbells Set (5-20kg)', 'category' => 'Sports', 'description' => 'Set of rubber-coated dumbbells: 5kg, 10kg, 15kg, and 20kg pairs. Includes a small rack. Perfect for home gym. No rust or damage.'],
    ];

    public function definition(): array
    {
        $sample = fake()->randomElement(self::$sampleListings);

        return [
            'user_id' => User::factory(),
            'title' => $sample['title'],
            'description' => $sample['description'],
            'price' => fake()->randomFloat(2, 200, 150000),
            'category' => $sample['category'],
            'condition' => fake()->randomElement(['New', 'Like New', 'Used']),
            'neighborhood' => fake()->randomElement(['Kezira', 'Megala', 'Taiwan', 'Sabiyan', 'Gendekore', 'Addis Ketema', 'Lega Hare', 'Hafetessa', 'Dechatu', 'Gende Gerada']),
            'phone_number' => '09' . fake()->numerify('########'),
            'images' => null,
            'is_sold' => false,
            'status' => 'approved',
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function sold(): static
    {
        return $this->state(fn () => ['is_sold' => true]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
            'rejection_reason' => fake()->randomElement([
                'Listing contains inappropriate content.',
                'Price seems unrealistic, please revise.',
                'Description is too vague, please add more details.',
            ]),
        ]);
    }
}
