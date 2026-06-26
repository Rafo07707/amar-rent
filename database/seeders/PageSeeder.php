<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => [
                'title' => [
                    'hy' => 'Ճանապարհը սկսվում է այստեղ',
                    'ru' => 'Аренда авто в Армении — Amar Rent Car',
                    'en' => 'Rent a Car in Armenia — Amar Rent Car',
                ],
                'content' => [
                    'hy' => 'Ավտովարձույթ ամբողջ Հայաստանում՝ ամբողջ ապահովագրությամբ, առանց թաքնված վճարների, առաքում ուղիղ ձեր մուտքի մոտ։',
                    'ru' => 'Аренда автомобилей по всей Армении с полной страховкой, без скрытых платежей, с доставкой к вашей двери.',
                    'en' => 'Car rental across Armenia with full insurance, no hidden fees, and delivery right to your door.',
                ],
                'meta_title' => [
                    'hy' => 'Ավտովարձույթ Հայաստանում | Amar Rent Car Armenia',
                    'ru' => 'Аренда авто в Армении | Amar Rent Car Armenia',
                    'en' => 'Rent a Car in Armenia | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Մատչելի ավտովարձույթ Երևանում, Գյումրիում, Դիլիջանում և Ծաղկաձորում։ Ամբողջ ապահովագրություն, 0 ֏ ավելորդ վճար, 24/7 աջակցություն, անվճար առաքում։',
                    'ru' => 'Доступная аренда авто в Ереване, Гюмри, Дилижане и Цахкадзоре. Полная страховка, без доплат, поддержка 24/7, бесплатная доставка.',
                    'en' => 'Affordable car rental in Yerevan, Gyumri, Dilijan and Tsaghkadzor. Full insurance, zero excess, 24/7 support, free delivery.',
                ],
            ],
            'about' => [
                'title' => [
                    'hy' => 'Մեր մասին',
                    'ru' => 'О нас',
                    'en' => 'About Us',
                ],
                'content' => [
                    'hy' => 'Amar Rent Car Armenia-ն հիմնադրվել է 2021 թվականին Երևանում՝ մի փոքր թիմի կողմից, ով ինքն էր ճանապարհորդել Հայաստանով և գիտեր, թե ինչ է բացակայում տեղական ավտովարձույթի շուկայում՝ թափանցիկ գներ, ճշգրիտ ապահովագրություն և իրական մատչելի սպասարկում։ Այսօր մենք գործում ենք չորս մասնաճյուղերով՝ Երևան, Գյումրի, Դիլիջան և Ծաղկաձոր, և ամեն տարի օգնում ենք հազարավոր ուղևորների բացահայտել Հայաստանի լեռները, լճերը և հին քաղաքները։',
                    'ru' => 'Amar Rent Car Armenia основана в 2021 году в Ереване небольшой командой, которая сама много путешествовала по Армении и знала, чего не хватает на местном рынке аренды авто: прозрачных цен, понятной страховки и реально доступного сервиса. Сегодня у нас четыре филиала — Ереван, Гюмри, Дилижан и Цахкадзор, и каждый год мы помогаем тысячам путешественников открыть для себя горы, озёра и древние города Армении.',
                    'en' => 'Amar Rent Car Armenia was founded in 2021 in Yerevan by a small team who had travelled Armenia themselves and knew what the local car rental market was missing: transparent pricing, real insurance, and genuinely accessible service. Today we operate from four branches — Yerevan, Gyumri, Dilijan and Tsaghkadzor — and every year we help thousands of travellers discover Armenia\'s mountains, lakes and ancient towns.',
                ],
                'meta_title' => [
                    'hy' => 'Մեր մասին | Amar Rent Car Armenia',
                    'ru' => 'О нас | Amar Rent Car Armenia',
                    'en' => 'About Us | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Իմացեք Amar Rent Car Armenia-ի մասին՝ Հայաստանի վստահված ավտովարձույթի ընկերության, որն առաջարկում է թափանցիկ գներ և ամբողջ ապահովագրություն։',
                    'ru' => 'Узнайте больше о Amar Rent Car Armenia — надёжной компании по аренде автомобилей в Армении с прозрачными ценами и полной страховкой.',
                    'en' => "Learn about Amar Rent Car Armenia, Armenia's trusted car rental company offering transparent pricing and full insurance.",
                ],
            ],
            'services' => [
                'title' => [
                    'hy' => 'Ծառայություններ',
                    'ru' => 'Услуги',
                    'en' => 'Services',
                ],
                'content' => [
                    'hy' => 'Ամբողջ ապահովագրություն, առաքում և վերադարձ ցանկացած կետում, անհատական մենեջեր, ճանապարհային աջակցություն, անվճար չեղարկում և թափանցիկ գնագոյացում։',
                    'ru' => 'Полная страховка, доставка и возврат в любой точке, персональный менеджер, помощь на дороге, бесплатная отмена и прозрачное ценообразование.',
                    'en' => 'Full insurance, delivery and return anywhere, a personal manager, roadside assistance, free cancellation and transparent pricing.',
                ],
                'meta_title' => [
                    'hy' => 'Ծառայություններ | Amar Rent Car Armenia',
                    'ru' => 'Услуги | Amar Rent Car Armenia',
                    'en' => 'Services | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Ամբողջ ապահովագրություն, առաքում, ճանապարհային աջակցություն և լրացուցիչ ծառայություններ՝ մանկական նստատեղեր, GPS, ձմեռային անվադողեր։',
                    'ru' => 'Полная страховка, доставка, помощь на дороге и дополнительные услуги: детские кресла, GPS, зимние шины.',
                    'en' => 'Full insurance, delivery, roadside assistance and extras like child seats, GPS and winter tyres.',
                ],
            ],
            'contact' => [
                'title' => [
                    'hy' => 'Կապ մեզ հետ',
                    'ru' => 'Связаться с нами',
                    'en' => 'Contact Us',
                ],
                'content' => [
                    'hy' => 'Հարցեր ունեք: Մենք պատրաստ ենք օգնել ցանկացած պահի։',
                    'ru' => 'Есть вопросы? Мы всегда готовы помочь.',
                    'en' => 'Have questions? We are here to help, anytime.',
                ],
                'meta_title' => [
                    'hy' => 'Կապ | Amar Rent Car Armenia',
                    'ru' => 'Контакты | Amar Rent Car Armenia',
                    'en' => 'Contact | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Կապվեք Amar Rent Car Armenia-ի հետ՝ ավտովարձույթի վերաբերյալ հարցերի և ամրագրումների համար։',
                    'ru' => 'Свяжитесь с Amar Rent Car Armenia по вопросам аренды и бронирования автомобилей.',
                    'en' => 'Get in touch with Amar Rent Car Armenia for rental questions and bookings.',
                ],
            ],
            'privacy' => [
                'title' => [
                    'hy' => 'Գաղտնիության քաղաքականություն',
                    'ru' => 'Политика конфиденциальности',
                    'en' => 'Privacy Policy',
                ],
                'content' => [
                    'hy' => "<h2>1. Ընդհանուր դրույթներ</h2><p>Amar Rent Car Armenia ՍՊԸ-ն (այսուհետ՝ «Ընկերություն») հավաքագրում և մշակում է անձնական տվյալներ բացառապես ավտոմեքենաների վարձակալման ծառայությունների մատուցման նպատակով։</p><h2>2. Ինչ տվյալներ ենք հավաքագրում</h2><p>Անուն, ազգանուն, կոնտակտային տվյալներ, վարորդական իրավունքի և անձնագրի տվյալներ, վարձակալման պատվերի մանրամասներ։</p><h2>3. Տվյալների օգտագործումը</h2><p>Տվյալները օգտագործվում են պատվերի մշակման, պայմանագրի կազմման և հաճախորդների աջակցության նպատակով։</p><h2>4. Ձեր իրավունքները</h2><p>Դուք իրավունք ունեք ստանալ տեղեկություն ձեր մասին պահպանված տվյալների վերաբերյալ, պահանջել ուղղում կամ ջնջում։</p><h2>5. Կապ</h2><p>Գաղտնիության հետ կապված հարցերի համար գրեք info@amarentcar.am։</p>",
                    'ru' => "<h2>1. Общие положения</h2><p>ООО Amar Rent Car Armenia (далее — «Компания») собирает и обрабатывает персональные данные исключительно для оказания услуг по аренде автомобилей.</p><h2>2. Какие данные мы собираем</h2><p>Имя, фамилия, контактные данные, данные водительского удостоверения и паспорта, детали заказа аренды.</p><h2>3. Использование данных</h2><p>Данные используются для обработки заказа, оформления договора и поддержки клиентов.</p><h2>4. Ваши права</h2><p>Вы имеете право получить информацию о хранимых данных, запросить их исправление или удаление.</p><h2>5. Контакты</h2><p>По вопросам конфиденциальности пишите на info@amarentcar.am.</p>",
                    'en' => "<h2>1. General provisions</h2><p>Amar Rent Car Armenia LLC (the \"Company\") collects and processes personal data solely for the purpose of providing car rental services.</p><h2>2. What data we collect</h2><p>Name, contact details, driving licence and passport details, and rental order details.</p><h2>3. Use of data</h2><p>Data is used to process orders, prepare contracts, and provide customer support.</p><h2>4. Your rights</h2><p>You have the right to access the data we hold about you, and to request correction or deletion.</p><h2>5. Contact</h2><p>For privacy-related questions, email info@amarentcar.am.</p>",
                ],
                'meta_title' => [
                    'hy' => 'Գաղտնիության քաղաքականություն | Amar Rent Car Armenia',
                    'ru' => 'Политика конфиденциальности | Amar Rent Car Armenia',
                    'en' => 'Privacy Policy | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Amar Rent Car Armenia-ի գաղտնիության քաղաքականությունը՝ անձնական տվյալների հավաքագրում և մշակում։',
                    'ru' => 'Политика конфиденциальности Amar Rent Car Armenia: сбор и обработка персональных данных.',
                    'en' => "Amar Rent Car Armenia's privacy policy covering collection and processing of personal data.",
                ],
            ],
            'terms' => [
                'title' => [
                    'hy' => 'Կանոններ և պայմաններ',
                    'ru' => 'Условия использования',
                    'en' => 'Terms & Conditions',
                ],
                'content' => [
                    'hy' => "<h2>1. Ամրագրման պայմաններ</h2><p>Ամրագրումը հաստատվում է կանխավճարից կամ կապի հետ հաստատումից հետո։ Գինը ներառում է ապահովագրությունը, եթե այլ բան նշված չէ։</p><h2>2. Չեղարկման քաղաքականություն</h2><p>Անվճար չեղարկում թույլատրվում է մինչև 24 ժամ նախքան մեքենայի ստացումը։</p><h2>3. Վարորդի պահանջներ</h2><p>Նվազագույն տարիք՝ 21 տարեկան (պրեմիում դասի համար՝ 25), վավեր վարորդական իրավունք առնվազն 2 տարվա փորձառությամբ։</p><h2>4. Ապահովագրություն</h2><p>Բոլոր մեքենաները ապահովագրված են CDW և TPL ապահովագրությամբ՝ 0 ֏ պատասխանատվությամբ։</p><h2>5. Ավանդ</h2><p>Մեքենայի ստացման ժամանակ գանձվում է ավանդ՝ որպես երաշխիք, որը ամբողջությամբ վերադարձվում է ստուգումից հետո։</p><h2>6. Վառելիքի քաղաքականություն</h2><p>Մեքենան տրամադրվում է ամբողջական բենզինով և պետք է վերադարձվի նույն մակարդակով։</p>",
                    'ru' => "<h2>1. Условия бронирования</h2><p>Бронирование подтверждается после предоплаты или подтверждения по телефону. Цена включает страховку, если не указано иное.</p><h2>2. Политика отмены</h2><p>Бесплатная отмена возможна не позднее чем за 24 часа до получения автомобиля.</p><h2>3. Требования к водителю</h2><p>Минимальный возраст — 21 год (для премиум-класса — 25), действующее водительское удостоверение со стажем не менее 2 лет.</p><h2>4. Страхование</h2><p>Все автомобили застрахованы по CDW и TPL с нулевой франшизой.</p><h2>5. Залог</h2><p>При получении автомобиля взимается залог в качестве гарантии, который полностью возвращается после проверки.</p><h2>6. Топливная политика</h2><p>Автомобиль предоставляется с полным баком и должен быть возвращён с тем же уровнем топлива.</p>",
                    'en' => "<h2>1. Booking terms</h2><p>A booking is confirmed after a deposit or phone confirmation. The price includes insurance unless stated otherwise.</p><h2>2. Cancellation policy</h2><p>Free cancellation is allowed up to 24 hours before pickup.</p><h2>3. Driver requirements</h2><p>Minimum age 21 (25 for the premium class), with a valid driving licence held for at least 2 years.</p><h2>4. Insurance</h2><p>All cars are covered by CDW and TPL insurance with zero excess.</p><h2>5. Deposit</h2><p>A deposit is taken at pickup as a guarantee and is fully refunded after inspection.</p><h2>6. Fuel policy</h2><p>The car is provided with a full tank and must be returned at the same level.</p>",
                ],
                'meta_title' => [
                    'hy' => 'Կանոններ և պայմաններ | Amar Rent Car Armenia',
                    'ru' => 'Условия использования | Amar Rent Car Armenia',
                    'en' => 'Terms & Conditions | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Ավտովարձույթի կանոններ և պայմաններ՝ ամրագրում, ապահովագրություն, ավանդ, վառելիքի քաղաքականություն։',
                    'ru' => 'Условия аренды авто: бронирование, страхование, залог, топливная политика.',
                    'en' => 'Car rental terms and conditions: booking, insurance, deposit, fuel policy.',
                ],
            ],
            'faq' => [
                'title' => [
                    'hy' => 'Հաճախ տրվող հարցեր',
                    'ru' => 'Часто задаваемые вопросы',
                    'en' => 'Frequently Asked Questions',
                ],
                'content' => [
                    'hy' => 'Պատասխաններ ամրագրումից, ապահովագրությունից ու ստացումից առաջ',
                    'ru' => 'Ответы перед бронированием, страхованием и получением автомобиля',
                    'en' => 'Answers before you book, insure, and pick up your car',
                ],
                'meta_title' => [
                    'hy' => 'Հաճախ տրվող հարցեր | Amar Rent Car Armenia',
                    'ru' => 'Часто задаваемые вопросы | Amar Rent Car Armenia',
                    'en' => 'FAQ | Amar Rent Car Armenia',
                ],
                'meta_description' => [
                    'hy' => 'Պատասխաններ հաճախակի տրվող հարցերին ավտովարձույթի, ապահովագրության, ավանդի և ստացման մասին։',
                    'ru' => 'Ответы на частые вопросы об аренде авто, страховке, залоге и получении машины.',
                    'en' => 'Answers to common questions about car rental, insurance, deposits, and pickup.',
                ],
            ],
        ];

        foreach ($pages as $slug => $data) {
            $page = Page::firstOrNew(['slug' => $slug]);
            $page->slug = $slug;
            $page->setTranslations('title', $data['title']);
            $page->setTranslations('content', $data['content']);
            $page->setTranslations('meta_title', $data['meta_title']);
            $page->setTranslations('meta_description', $data['meta_description']);
            $page->save();
        }
    }
}
