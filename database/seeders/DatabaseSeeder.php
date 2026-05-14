<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (Filament login)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@seanile.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Sample customer
        $customer = User::create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '+44 123 456 7890',
            'nationality' => 'British',
        ]);

        // Destinations
        $hurghada = Destination::create([
            'name' => 'Hurghada',
            'name_ar' => 'الغردقة',
            'tagline' => 'Red Sea Paradise',
            'tagline_ar' => 'جنة البحر الأحمر',
            'description' => 'Egypt\'s most beloved resort city, offering world-class diving, vibrant nightlife, and stunning coral reefs along the Red Sea coast.',
            'description_ar' => 'المدينة المنتجعية الأكثر شعبية في مصر، تقدم غوصاً عالمي المستوى وحياة ليلية نابضة وشعاباً مرجانية مذهلة على ساحل البحر الأحمر.',
            'image' => '/images/hurghada-main.jpg',
            'trips_count' => 15,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $marsaAlam = Destination::create([
            'name' => 'Marsa Alam',
            'name_ar' => 'مرسى علم',
            'tagline' => 'Untouched Marine Beauty',
            'tagline_ar' => 'جمال بحري بكر',
            'description' => 'A hidden gem on the Red Sea, renowned for its pristine waters, dugongs, dolphins, and some of the world\'s most biodiverse coral ecosystems.',
            'description_ar' => 'جوهرة مخفية على البحر الأحمر، تشتهر بمياهها العذراء والدوغونغ والدلافين وبعض من أكثر النظم البيئية المرجانية تنوعاً في العالم.',
            'image' => '/images/marsa-alam-dolphins.jpg',
            'trips_count' => 10,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $luxor = Destination::create([
            'name' => 'Luxor',
            'name_ar' => 'الأقصر',
            'tagline' => 'Land of Pharaohs',
            'tagline_ar' => 'أرض الفراعنة',
            'description' => 'The world\'s greatest open-air museum, home to Karnak Temple, Valley of the Kings, and thousands of years of ancient Egyptian history.',
            'description_ar' => 'أعظم متحف مفتوح في العالم، موطن معبد الكرنك ووادي الملوك وآلاف السنين من التاريخ المصري القديم.',
            'image' => '/images/safari.jpg',
            'trips_count' => 18,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Destination::create([
            'name' => 'Sharm El Sheikh',
            'name_ar' => 'شرم الشيخ',
            'tagline' => 'Luxury Coastal Escape',
            'tagline_ar' => 'ملاذ ساحلي فاخر',
            'description' => 'A world-famous resort at the tip of the Sinai Peninsula, offering spectacular diving, luxury hotels, and vibrant underwater life.',
            'description_ar' => 'منتجع عالمي الشهرة في أقصى جنوب شبه جزيرة سيناء، يقدم غوصاً رائعاً وفنادق فاخرة وحياة بحرية نابضة.',
            'image' => '/images/orange-bay.jpg',
            'trips_count' => 12,
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Trips
        $trips = [
            [
                'destination_id' => $hurghada->id,
                'title' => 'Coral Reef Diving Adventure',
                'title_ar' => 'مغامرة غوص الشعاب المرجانية',
                'description' => 'Explore the magnificent coral reefs of Hurghada with our expert diving team. Suitable for all levels from beginners to advanced divers.',
                'description_ar' => 'استكشف الشعاب المرجانية الرائعة في الغردقة مع فريق الغوص المتخصص لدينا. مناسب لجميع المستويات من المبتدئين إلى المتقدمين.',
                'category' => 'diving',
                'price' => 150.00,
                'original_price' => 200.00,
                'rating' => 4.9,
                'reviews_count' => 287,
                'duration' => '8 hours',
                'duration_hours' => 8,
                'min_people' => 2,
                'max_people' => 12,
                'badge' => 'bestSeller',
                'includes_food' => true,
                'includes_insurance' => true,
                'includes_pickup' => true,
                'highlights' => ['2 dive sites', 'All equipment provided', 'Certified instructors', 'Underwater photos included', 'Fish feeding experience'],
                'image' => '/images/diving.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'destination_id' => $hurghada->id,
                'title' => 'Orange Bay Island Tour',
                'title_ar' => 'جولة جزيرة أورانج باي',
                'description' => 'Spend a magical day at the stunning Orange Bay Island — crystal-clear waters, white sandy beaches, snorkeling, and pure relaxation.',
                'description_ar' => 'اقضِ يوماً سحرياً في جزيرة أورانج باي الرائعة — مياه صافية كالكريستال وشواطئ رملية بيضاء وغطس وراحة تامة.',
                'category' => 'beach',
                'price' => 120.00,
                'original_price' => 160.00,
                'rating' => 4.8,
                'reviews_count' => 412,
                'duration' => '6 hours',
                'duration_hours' => 6,
                'min_people' => 1,
                'max_people' => 20,
                'badge' => 'topRated',
                'includes_food' => true,
                'includes_insurance' => false,
                'includes_pickup' => true,
                'highlights' => ['Private beach access', 'Snorkeling gear', 'BBQ lunch', 'Banana boat ride', 'Glass-bottom boat'],
                'image' => '/images/orange-bay.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'destination_id' => $marsaAlam->id,
                'title' => 'Dolphins & Turtles Snorkeling',
                'title_ar' => 'غطس مع الدلافين والسلاحف',
                'description' => 'Swim with wild dolphins and sea turtles in the pristine waters of Marsa Alam — an experience you will treasure forever.',
                'description_ar' => 'اسبح مع الدلافين البرية والسلاحف البحرية في المياه البكر لمرسى علم — تجربة ستحتفظ بها في ذاكرتك للأبد.',
                'category' => 'diving',
                'price' => 180.00,
                'original_price' => 220.00,
                'rating' => 5.0,
                'reviews_count' => 156,
                'duration' => '10 hours',
                'duration_hours' => 10,
                'min_people' => 2,
                'max_people' => 8,
                'badge' => 'limitedSeats',
                'includes_food' => true,
                'includes_insurance' => true,
                'includes_pickup' => true,
                'highlights' => ['Guaranteed dolphin sighting', 'Sea turtle spots', 'Professional guide', 'Lunch included', 'Transfer from Hurghada available'],
                'image' => '/images/marsa-alam-dolphins.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'destination_id' => $hurghada->id,
                'title' => 'Desert Safari & Bedouin Camp',
                'title_ar' => 'سفاري الصحراء ومخيم البدو',
                'description' => 'Ride quad bikes through the Eastern Desert, visit a Bedouin village, watch the sunset over golden dunes, and enjoy a traditional dinner under the stars.',
                'description_ar' => 'اركب الدراجات الرباعية عبر الصحراء الشرقية، وزر قرية بدوية، وشاهد الغروب فوق الكثبان الذهبية، واستمتع بعشاء تقليدي تحت النجوم.',
                'category' => 'safari',
                'price' => 95.00,
                'original_price' => 120.00,
                'rating' => 4.7,
                'reviews_count' => 334,
                'duration' => '5 hours',
                'duration_hours' => 5,
                'min_people' => 2,
                'max_people' => 15,
                'badge' => 'bestSeller',
                'includes_food' => true,
                'includes_insurance' => false,
                'includes_pickup' => true,
                'highlights' => ['Quad bike ride', 'Camel ride', 'Bedouin tea & coffee', 'Traditional dinner', 'Stargazing'],
                'image' => '/images/safari.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'destination_id' => $hurghada->id,
                'title' => 'Luxury Yacht Cruise',
                'title_ar' => 'رحلة يخت فاخرة',
                'description' => 'Sail the Red Sea in style aboard our luxury yacht. Multiple snorkeling stops, gourmet meals, and breathtaking views of the coastline.',
                'description_ar' => 'أبحر في البحر الأحمر بأناقة على متن يختنا الفاخر. محطات غطس متعددة ووجبات فاخرة ومناظر خلابة للساحل.',
                'category' => 'cruise',
                'price' => 200.00,
                'original_price' => 280.00,
                'rating' => 4.9,
                'reviews_count' => 89,
                'duration' => '12 hours',
                'duration_hours' => 12,
                'min_people' => 2,
                'max_people' => 10,
                'badge' => 'luxury',
                'includes_food' => true,
                'includes_insurance' => true,
                'includes_pickup' => true,
                'highlights' => ['Private yacht', 'Gourmet meals', '3 snorkeling spots', 'Fishing session', 'Sunset cocktails'],
                'image' => '/images/trip-island.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'destination_id' => $luxor->id,
                'title' => 'Karnak Temple & Luxor Day Trip',
                'title_ar' => 'رحلة معبد الكرنك والأقصر ليوم',
                'description' => 'Journey back in time with a guided tour of the awe-inspiring Karnak Temple Complex and Luxor Temple — the grandest monuments of ancient Egypt.',
                'description_ar' => 'سافر عبر الزمن مع جولة مُرشدة في مجمع معبد الكرنك الرائع ومعبد الأقصر — أعظم آثار مصر القديمة.',
                'category' => 'safari',
                'price' => 85.00,
                'original_price' => 110.00,
                'rating' => 4.8,
                'reviews_count' => 201,
                'duration' => '10 hours',
                'duration_hours' => 10,
                'min_people' => 1,
                'max_people' => 20,
                'badge' => 'topRated',
                'includes_food' => false,
                'includes_insurance' => false,
                'includes_pickup' => true,
                'highlights' => ['Karnak Temple Complex', 'Luxor Temple', 'Expert Egyptologist guide', 'Air-conditioned transport', 'Entrance fees included'],
                'image' => '/images/trip-safari.jpg',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($trips as $tripData) {
            Trip::create($tripData);
        }

        // Blog Posts
        $blogPosts = [
            [
                'title' => 'Top 10 Dive Sites in Hurghada',
                'title_ar' => 'أفضل 10 مواقع غوص في الغردقة',
                'slug' => 'top-10-dive-sites-hurghada',
                'excerpt' => 'Discover the most breathtaking underwater worlds the Red Sea has to offer, from the famous Abu Nuhas shipwrecks to the colorful reefs of Giftun Island.',
                'excerpt_ar' => 'اكتشف أكثر العوالم المائية إبهاراً في البحر الأحمر، من حطام السفن الشهير أبو نحاس إلى الشعاب الملونة في جزيرة جفتون.',
                'content' => '<p>The Red Sea around Hurghada is home to some of the most spectacular dive sites in the world...</p>',
                'author' => 'Ahmed Hassan',
                'category' => 'Water Sports',
                'read_time' => 7,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'A Guide to Red Sea Wildlife',
                'title_ar' => 'دليل الحياة البرية في البحر الأحمر',
                'slug' => 'guide-red-sea-wildlife',
                'excerpt' => 'From magnificent manta rays to playful dolphins, the Red Sea is teeming with incredible marine life waiting to be discovered.',
                'excerpt_ar' => 'من أشعة المانتا الرائعة إلى الدلافين المرحة، البحر الأحمر يعج بالحياة البحرية المذهلة التي تنتظر الاكتشاف.',
                'content' => '<p>The Red Sea is one of the world\'s most biodiverse marine environments...</p>',
                'author' => 'Fatima Mahmoud',
                'category' => 'Travel',
                'read_time' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Desert Safari Tips for First-Timers',
                'title_ar' => 'نصائح سفاري الصحراء للمبتدئين',
                'slug' => 'desert-safari-tips-first-timers',
                'excerpt' => 'Everything you need to know before heading out on your first Egyptian desert adventure — what to wear, bring, and expect.',
                'excerpt_ar' => 'كل ما تحتاج معرفته قبل الذهاب في أول مغامرة صحراوية مصرية — ماذا تلبس وتحضر وتتوقع.',
                'content' => '<p>The Egyptian Eastern Desert is a magical landscape of golden dunes and ancient mountains...</p>',
                'author' => 'Mohamed Ali',
                'category' => 'Adventures',
                'read_time' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Ancient Egypt: Exploring Luxor in a Day',
                'title_ar' => 'مصر القديمة: استكشاف الأقصر في يوم',
                'slug' => 'ancient-egypt-exploring-luxor',
                'excerpt' => 'How to make the most of a day trip to Luxor — the world\'s greatest open-air museum packed with millennia of history.',
                'excerpt_ar' => 'كيف تستفيد من رحلة يوم واحد إلى الأقصر — أعظم متحف مفتوح في العالم المليء بآلاف السنين من التاريخ.',
                'content' => '<p>Luxor is arguably the most remarkable historical destination in the entire world...</p>',
                'author' => 'Layla AbdulRahman',
                'category' => 'History',
                'read_time' => 8,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Best Time to Visit the Red Sea',
                'title_ar' => 'أفضل وقت لزيارة البحر الأحمر',
                'slug' => 'best-time-visit-red-sea',
                'excerpt' => 'A month-by-month breakdown of what to expect when visiting Egypt\'s Red Sea coast, from weather to marine life encounters.',
                'excerpt_ar' => 'تحليل شهري لما يمكن توقعه عند زيارة ساحل البحر الأحمر المصري، من الطقس إلى مواجهات الحياة البحرية.',
                'content' => '<p>The Red Sea coast of Egypt enjoys a wonderfully warm climate year-round...</p>',
                'author' => 'Sara Mohamed',
                'category' => 'Travel',
                'read_time' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'Snorkeling vs Scuba Diving: Which Is Right for You?',
                'title_ar' => 'الغطس مقابل الغوص: أيهما الأنسب لك؟',
                'slug' => 'snorkeling-vs-scuba-diving',
                'excerpt' => 'Can\'t decide between snorkeling and scuba diving? Here\'s a comprehensive comparison to help you choose the right Red Sea experience.',
                'excerpt_ar' => 'لا تستطيع الاختيار بين الغطس والغوص؟ إليك مقارنة شاملة تساعدك على اختيار تجربة البحر الأحمر المناسبة.',
                'content' => '<p>Both snorkeling and scuba diving offer incredible ways to explore the Red Sea...</p>',
                'author' => 'Ahmed Hassan',
                'category' => 'Water Sports',
                'read_time' => 6,
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($blogPosts as $post) {
            BlogPost::create($post);
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Klaus Weber',
                'nationality' => 'German',
                'trip' => 'Coral Reef Diving Adventure',
                'rating' => 5,
                'content' => 'Absolutely incredible experience! The guides were professional and the coral reefs were the most beautiful I\'ve ever seen. Will definitely book again!',
                'content_ar' => 'تجربة رائعة للغاية! كان المرشدون محترفين والشعاب المرجانية كانت الأجمل التي رأيتها على الإطلاق. سأحجز مرة أخرى بالتأكيد!',
                'is_active' => true,
            ],
            [
                'name' => 'Emma Thompson',
                'nationality' => 'British',
                'trip' => 'Orange Bay Island Tour',
                'rating' => 5,
                'content' => 'Orange Bay was like paradise on earth! Crystal clear water, white sand beach, and the snorkeling was amazing. SeaNile made everything perfect.',
                'content_ar' => 'كانت أورانج باي مثل الجنة على الأرض! مياه صافية كالكريستال وشاطئ رملي أبيض وكان الغطس رائعاً. جعل SeaNile كل شيء مثالياً.',
                'is_active' => true,
            ],
            [
                'name' => 'Ivan Petrov',
                'nationality' => 'Russian',
                'trip' => 'Dolphins & Turtles Snorkeling',
                'rating' => 5,
                'content' => 'Swimming with wild dolphins was a dream come true! Our guide knew exactly where to find them. This was the highlight of our entire Egypt trip!',
                'content_ar' => 'كان السباحة مع الدلافين البرية حلماً تحقق! كان مرشدنا يعرف بالضبط أين يجدها. كانت هذه أبرز لحظات رحلتنا بأكملها إلى مصر!',
                'is_active' => true,
            ],
            [
                'name' => 'Marie Dupont',
                'nationality' => 'French',
                'trip' => 'Desert Safari & Bedouin Camp',
                'rating' => 5,
                'content' => 'The desert safari was magical — quad bikes, camels, Bedouin dinner under the stars. An experience we\'ll treasure forever. Highly recommended!',
                'content_ar' => 'كانت سفاري الصحراء ساحرة — دراجات رباعية وجمال وعشاء بدوي تحت النجوم. تجربة سنحتفظ بها في ذاكرتنا للأبد. موصى به للغاية!',
                'is_active' => true,
            ],
            [
                'name' => 'Marco Rossi',
                'nationality' => 'Italian',
                'trip' => 'Luxury Yacht Cruise',
                'rating' => 5,
                'content' => 'The yacht cruise was pure luxury. Excellent food, stunning views, and multiple snorkeling spots. Worth every penny. SeaNile knows how to pamper guests!',
                'content_ar' => 'كانت رحلة اليخت فخامة خالصة. طعام ممتاز ومناظر خلابة ومواقع غطس متعددة. يستحق كل قرش. SeaNile تعرف كيف تدلل الضيوف!',
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'nationality' => 'American',
                'trip' => 'Karnak Temple & Luxor Day Trip',
                'rating' => 5,
                'content' => 'Our guide was incredibly knowledgeable about ancient Egyptian history. Karnak Temple was awe-inspiring. Best cultural experience of my life!',
                'content_ar' => 'كان مرشدنا يتمتع بمعرفة واسعة بالتاريخ المصري القديم. كان معبد الكرنك مبهراً. أفضل تجربة ثقافية في حياتي!',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // Sample bookings
        $trip = Trip::first();
        if ($trip) {
            Booking::create([
                'booking_number' => 'BK-A7K3M',
                'user_id' => $customer->id,
                'trip_id' => $trip->id,
                'full_name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '+44 123 456 7890',
                'nationality' => 'British',
                'hotel' => 'Steigenberger Aqua Magic',
                'trip_date' => now()->addDays(7)->toDateString(),
                'preferred_time' => '09:00',
                'adults' => 2,
                'children' => 0,
                'infants' => 0,
                'payment_method' => 'card',
                'currency' => 'USD',
                'subtotal' => 300.00,
                'discount' => 0,
                'tax' => 42.00,
                'total' => 342.00,
                'status' => 'confirmed',
            ]);

            Booking::create([
                'booking_number' => 'BK-X9P2Q',
                'user_id' => $customer->id,
                'trip_id' => $trip->id,
                'full_name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '+44 123 456 7890',
                'nationality' => 'British',
                'hotel' => 'Steigenberger Aqua Magic',
                'trip_date' => now()->subDays(30)->toDateString(),
                'preferred_time' => '09:00',
                'adults' => 2,
                'children' => 1,
                'infants' => 0,
                'payment_method' => 'cash',
                'currency' => 'USD',
                'subtotal' => 375.00,
                'discount' => 37.50,
                'tax' => 47.25,
                'total' => 384.75,
                'status' => 'completed',
            ]);
        }
    }
}
