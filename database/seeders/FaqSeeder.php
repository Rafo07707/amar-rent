<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => [
                    'hy' => 'Ինչ փաստաթղթեր են պետք մեքենա վարձելու համար',
                    'ru' => 'Какие документы нужны для аренды автомобиля',
                    'en' => 'What documents do I need to rent a car',
                ],
                'answer' => [
                    'hy' => 'Անձնագիր կամ ID քարտ, և վարորդական իրավունք (առնվազն B կատեգորիա)։ Արտասահմանյան քաղաքացիների համար ընդունվում է նաև միջազգային վարորդական իրավունք։',
                    'ru' => 'Паспорт или ID-карта, а также водительское удостоверение (минимум категория B). Для иностранных граждан принимается международное водительское удостоверение.',
                    'en' => 'A passport or ID card, and a driving licence (category B minimum). International driving licences are accepted for foreign citizens.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ապահովագրությունը ներառված է գնի մեջ',
                    'ru' => 'Включена ли страховка в стоимость',
                    'en' => 'Is insurance included in the price',
                ],
                'answer' => [
                    'hy' => 'Այո, ամբողջ ապահովագրությունը (CDW և TPL) ներառված է յուրաքանչյուր ամրագրման մեջ՝ 0 ֏ պատասխանատվությամբ։',
                    'ru' => 'Да, полная страховка (CDW и TPL) включена в каждое бронирование с нулевой франшизой.',
                    'en' => 'Yes, full insurance (CDW and TPL) is included in every booking with zero excess.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Կարող եմ չեղարկել կամ փոխել ամրագրումը',
                    'ru' => 'Можно ли отменить или изменить бронирование',
                    'en' => 'Can I cancel or change my booking',
                ],
                'answer' => [
                    'hy' => 'Այո, անվճար չեղարկում կամ փոփոխություն հնարավոր է մինչև 24 ժամ նախքան մեքենայի ստացումը։',
                    'ru' => 'Да, бесплатная отмена или изменение возможны не позднее чем за 24 часа до получения автомобиля.',
                    'en' => 'Yes, free cancellation or changes are possible up to 24 hours before pickup.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ինչպիսին է վառելիքի քաղաքականությունը',
                    'ru' => 'Какая топливная политика',
                    'en' => "What's the fuel policy",
                ],
                'answer' => [
                    'hy' => 'Մեքենան տրվում է ամբողջական բենզինով, և պետք է վերադարձվի նույնպես ամբողջական բենզինով։',
                    'ru' => 'Автомобиль выдаётся с полным баком и должен быть возвращён с полным баком.',
                    'en' => 'The car is provided with a full tank and must be returned full.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ինչ է վարորդական տարիքային սահմանափակումը',
                    'ru' => 'Какое возрастное ограничение для водителя',
                    'en' => 'What is the minimum driver age',
                ],
                'answer' => [
                    'hy' => 'Նվազագույն տարիքը 21 տարեկան է, պրեմիում դասի մեքենաների համար՝ 25։',
                    'ru' => 'Минимальный возраст — 21 год, для премиум-класса — 25 лет.',
                    'en' => 'The minimum age is 21 (25 for premium-class cars).',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ինչպես է աշխատում օդանավակայանից ստացումը',
                    'ru' => 'Как работает получение в аэропорту',
                    'en' => 'How does airport pickup work',
                ],
                'answer' => [
                    'hy' => 'Մեր ներկայացուցիչը ձեզ կդիմավորի «Զվարթնոց» օդանավակայանում ժամանումի սպասասրահում, անկախ թռիչքի ժամից։',
                    'ru' => 'Наш представитель встретит вас в зале прибытия аэропорта «Звартноц», независимо от времени рейса.',
                    'en' => 'Our representative will meet you in the arrivals hall at Zvartnots Airport, regardless of your flight time.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Հնարավոր է երկարատև վարձույթ',
                    'ru' => 'Возможна ли долгосрочная аренда',
                    'en' => 'Is long-term rental possible',
                ],
                'answer' => [
                    'hy' => 'Այո, մենք առաջարկում ենք զեղչեր 7 օրից ավելի վարձույթի համար։',
                    'ru' => 'Да, мы предлагаем скидки при аренде на срок более 7 дней.',
                    'en' => 'Yes, we offer discounts for rentals longer than 7 days.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Կարո՞ղ եմ ստանալ մեքենան գիշերը',
                    'ru' => 'Можно ли получить автомобиль ночью',
                    'en' => 'Can I pick up the car at night',
                ],
                'answer' => [
                    'hy' => 'Այո, գիշերային ստացում և վերադարձ հասանելի է անվճար՝ նախնական պատվերով (22:00-08:00)։',
                    'ru' => 'Да, ночное получение и возврат доступны бесплатно по предварительной заявке (22:00-08:00).',
                    'en' => 'Yes, night pickup and return are available free of charge with prior arrangement (22:00-08:00).',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Մեքենան առաքում եք իմ հյուրանոց',
                    'ru' => 'Доставляете ли вы машину в отель',
                    'en' => 'Do you deliver the car to my hotel',
                ],
                'answer' => [
                    'hy' => 'Այո, անվճար առաքում Երևան քաղաքի սահմաններում։ Այլ քաղաքների համար կարող է կիրառվել փոքր լրավճար։',
                    'ru' => 'Да, бесплатная доставка в пределах Ереван. Для других городов может применяться небольшая доплата.',
                    'en' => 'Yes, free delivery within Yerevan. A small fee may apply for other cities.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ինչ է ընդգրկում ավանդը',
                    'ru' => 'Что покрывает залог',
                    'en' => 'What does the deposit cover',
                ],
                'answer' => [
                    'hy' => 'Ավանդը (50,000–150,000 ֏, ըստ դասի) ծառայում է որպես երաշխիք մանր վնասների կամ տրաֆիկի խախտումների համար։ Ամբողջությամբ վերադարձվում է ստուգումից հետո։',
                    'ru' => 'Залог (50 000–150 000 драм, в зависимости от класса) служит гарантией на случай мелких повреждений или нарушений ПДД. Полностью возвращается после проверки.',
                    'en' => 'The deposit (50,000–150,000 AMD depending on class) serves as a guarantee against minor damage or traffic violations. Fully refunded after inspection.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Կարո՞ղ եմ ավելացնել երկրորդ վարորդ',
                    'ru' => 'Можно ли добавить второго водителя',
                    'en' => 'Can I add an additional driver',
                ],
                'answer' => [
                    'hy' => 'Այո, լրացուցիչ վարորդ կարող է ավելացվել պայմանագրում 2,000 ֏ / օր արժեքով։',
                    'ru' => 'Да, дополнительный водитель может быть добавлен в договор за 2000 драм / день.',
                    'en' => 'Yes, an additional driver can be added to the contract for 2,000 AMD / day.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Մանկական նստատեղեր հասանելի են',
                    'ru' => 'Доступны ли детские кресла',
                    'en' => 'Are child seats available',
                ],
                'answer' => [
                    'hy' => 'Այո, ISOFIX մանկական նստատեղեր հասանելի են 1,500 ֏ / օր արժեքով։',
                    'ru' => 'Да, детские кресла ISOFIX доступны за 1500 драм / день.',
                    'en' => 'Yes, ISOFIX child seats are available for 1,500 AMD / day.',
                ],
            ],
            [
                'question' => [
                    'hy' => 'Ինչպես կապ հաստատել ընթացքում',
                    'ru' => 'Как связаться во время аренды',
                    'en' => 'How can I get in touch during my rental',
                ],
                'answer' => [
                    'hy' => 'Ամրագրումից հետո ստանում եք ձեր անհատական մենեջերի կոնտակտը՝ հասանելի WhatsApp-ով, հեռախոսով կամ էլ. փոստով 24/7։',
                    'ru' => 'После бронирования вы получите контакт своего персонального менеджера, доступного 24/7 через WhatsApp, по телефону или email.',
                    'en' => "After booking you'll receive your personal manager's contact, available 24/7 via WhatsApp, phone, or email.",
                ],
            ],
            [
                'question' => [
                    'hy' => 'Կարո՞ղ եմ վերադարձնել մեքենան այլ մասնաճյուղում',
                    'ru' => 'Можно ли вернуть машину в другом филиале',
                    'en' => 'Can I return the car to a different location',
                ],
                'answer' => [
                    'hy' => 'Այո, միակողմանի վերադարձ հնարավոր է մեր մասնաճյուղերի միջև՝ լրացուցիչ վճարով, որը կախված է հեռավորությունից։',
                    'ru' => 'Да, односторонний возврат возможен между нашими филиалами с дополнительной платой, зависящей от расстояния.',
                    'en' => 'Yes, one-way returns between our branches are possible for an extra fee depending on distance.',
                ],
            ],
        ];

        foreach ($faqs as $index => $data) {
            Faq::create([
                'question' => json_encode($data['question'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'answer' => json_encode($data['answer'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}
