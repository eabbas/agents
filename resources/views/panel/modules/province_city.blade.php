@php


$provinces = [
    '0' => 'لطفا استان را انتخاب نمایید',
    '1' => 'تهران',
    '2' => 'گیلان',
    '3' => 'آذربایجان شرقی',
    '4' => 'خوزستان',
    '5' => 'فارس',
    '6' => 'اصفهان',
    '7' => 'خراسان رضوی',
    '8' => 'قزوین',
    '9' => 'سمنان',
    '10' => 'قم',
    '11' => 'مرکزی',
    '12' => 'زنجان',
    '13' => 'مازندران',
    '14' => 'گلستان',
    '15' => 'اردبیل',
    '16' => 'آذربایجان غربی',
    '17' => 'همدان',
    '18' => 'کردستان',
    '19' => 'کرمانشاه',
    '20' => 'لرستان',
    '21' => 'بوشهر',
    '22' => 'کرمان',
    '23' => 'هرمزگان',
    '24' => 'چهارمحال و بختیاری',
    '25' => 'یزد',
    '26' => 'سیستان و بلوچستان',
    '27' => 'ایلام',
    '28' => 'کهگلویه و بویراحمد',
    '29' => 'خراسان شمالی',
    '30' => 'خراسان جنوبی',
    '31' => 'البرز',
];
@endphp


<div class="row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="province">استان</label>
            <select style="font-size: 9pt;" class="form-control province" name="province" onChange="iranwebsv(this);"
                selected="{{ old('province', $province ?? '') }}">
                @foreach ($provinces as $key => $value)
                    <option value="{{ $key == 0 ? 'default' : $value }}"
                        {{ old('province', $province ?? '') == $value ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('province'))
                <div class="invalid-feedback">
                    <small style="color: red">{{ $errors->first('province') }}</small>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="city">شهر</label>
            <select style="font-size: 9pt;" class="form-control city" name="city">
                <option value="0">لطفا شهر را انتخاب نمایید</option>
            </select>
            @if ($errors->has('city'))
                <div class="invalid-feedback">
                    <small style="color: red">{{ $errors->first('city') }}</small>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.province').each(function() {
            iranwebsv(this);

            @if ((old('form') && old('city')))
                // select old selected city
                const selected = '{{ old('city') ? old('city') : 0 }}';
                $('#{{ old('form') }}').find('.city option[value=\'' + selected + '\']').attr(
                    'selected',
                    'selected');
            @elseif (isset($form) && isset($city))
            const selected = '{{ $city ?? '0' }}';
                $('#{{ $form }}').find('.city option[value=\'' + selected + '\']').attr(
                    'selected',
                    'selected');
            @endif


        });
    });

    function iranwebsv(element) {

        let province = String(element.value);

        with($(element).parent().closest('.row').find('.city')[0]) {
            options.length = 0;

            if (province === 0) {
                options[0] = new Option('لطفا استان را انتخاب نمایید', 'default');
            }

            if (province === '{{ $provinces[1] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('احمدآبادمستوفی', 'احمدآبادمستوفی');
                options[2] = new Option('ادران', 'ادران');
                options[3] = new Option('اسلام آباد', 'اسلام آباد');
                options[4] = new Option('اسلام شهر', 'اسلام شهر');
                options[5] = new Option('اكبرآباد', 'اكبرآباد');
                options[6] = new Option('امیریه', 'امیریه');
                options[7] = new Option('اندیشه', 'اندیشه');
                options[8] = new Option('اوشان', 'اوشان');
                options[9] = new Option('آبسرد', 'آبسرد');
                options[10] = new Option('آبعلی', 'آبعلی');
                options[11] = new Option('باغستان', 'باغستان');
                options[12] = new Option('باقر شهر', 'باقر شهر');
                options[13] = new Option('برغان', 'برغان');
                options[14] = new Option('بومهن', 'بومهن');
                options[15] = new Option('پارچین', 'پارچین');
                options[16] = new Option('پاكدشت', 'پاكدشت');
                options[17] = new Option('پردیس', 'پردیس');
                options[18] = new Option('پرند', 'پرند');
                options[19] = new Option('پس قلعه', 'پس قلعه');
                options[20] = new Option('پیشوا', 'پیشوا');
                options[21] = new Option('تجزیه مبادلات لشكر  ', 'تجزیه مبادلات لشكر  ');
                options[22] = new Option('تهران', 'تهران');
                options[23] = new Option('جاجرود', 'جاجرود');
                options[24] = new Option('چرمسازی سالاریه', 'چرمسازی سالاریه');
                options[25] = new Option('چهاردانگه', 'چهاردانگه');
                options[26] = new Option('حسن آباد', 'حسن آباد');
                options[27] = new Option('حومه گلندوك', 'حومه گلندوك');
                options[28] = new Option('خاتون آباد', 'خاتون آباد');
                options[29] = new Option('خاوه', 'خاوه');
                options[30] = new Option('خرمدشت', 'خرمدشت');
                options[31] = new Option('دركه', 'دركه');
                options[32] = new Option('دماوند', 'دماوند');
                options[33] = new Option('رباط كریم', 'رباط كریم');
                options[34] = new Option('رزگان', 'رزگان');
                options[35] = new Option('رودهن', 'رودهن');
                options[36] = new Option('ری', 'ری');
                options[37] = new Option('سعیدآباد', 'سعیدآباد');
                options[38] = new Option('سلطان آباد', 'سلطان آباد');
                options[39] = new Option('سوهانك', 'سوهانك');
                options[40] = new Option('شاهدشهر', 'شاهدشهر');
                options[41] = new Option('شریف آباد', 'شریف آباد');
                options[42] = new Option('شمس آباد', 'شمس آباد');
                options[43] = new Option('شهر قدس', 'شهر قدس');
                options[44] = new Option('شهرآباد', 'شهرآباد');
                options[45] = new Option('شهرجدیدپردیس', 'شهرجدیدپردیس');
                options[46] = new Option('شهرقدس(مویز)', 'شهرقدس(مویز)');
                options[47] = new Option('شهریار', 'شهریار');
                options[48] = new Option('شهریاربردآباد', 'شهریاربردآباد');
                options[49] = new Option('صالح آباد', 'صالح آباد');
                options[50] = new Option('صفادشت', 'صفادشت');
                options[51] = new Option('فرودگاه امام خمینی', 'فرودگاه امام خمینی');
                options[52] = new Option('فرون آباد', 'فرون آباد');
                options[53] = new Option('فشم', 'فشم');
                options[54] = new Option('فیروزكوه', 'فیروزكوه');
                options[55] = new Option('قرچك', 'قرچك');
                options[56] = new Option('قیام دشت', 'قیام دشت');
                options[57] = new Option('كهریزك', 'كهریزك');
                options[58] = new Option('كیلان', 'كیلان');
                options[59] = new Option('گلدسته', 'گلدسته');
                options[60] = new Option('گلستان (بهارستان)', 'گلستان (بهارستان)');
                options[61] = new Option('گیلاوند', 'گیلاوند');
                options[62] = new Option('لواسان', 'لواسان');
                options[63] = new Option('لوسان بزرگ', 'لوسان بزرگ');
                options[64] = new Option('مارلیك', 'مارلیك');
                options[65] = new Option('مروزبهرام', 'مروزبهرام');
                options[66] = new Option('ملارد', 'ملارد');
                options[67] = new Option('منطقه 11 پستی تهران', 'منطقه 11 پستی تهران');
                options[68] = new Option('منطقه 13 پستی تهران', 'منطقه 13 پستی تهران');
                options[69] = new Option('منطقه 14 پستی تهران', 'منطقه 14 پستی تهران');
                options[70] = new Option('منطقه 15 پستی تهران', 'منطقه 15 پستی تهران');
                options[71] = new Option('منطقه 16 پستی تهران', 'منطقه 16 پستی تهران');
                options[72] = new Option('منطقه 17 پستی تهران  ', 'منطقه 17 پستی تهران  ');
                options[73] = new Option('منطقه 18 پستی تهران  ', 'منطقه 18 پستی تهران  ');
                options[74] = new Option('منطقه 19 پستی تهران  ', 'منطقه 19 پستی تهران  ');
                options[75] = new Option('نسیم شهر (بهارستان)', 'نسیم شهر (بهارستان)');
                options[76] = new Option('نصیرآباد', 'نصیرآباد');
                options[77] = new Option('واوان', 'واوان');
                options[78] = new Option('وحیدیه', 'وحیدیه');
                options[79] = new Option('ورامین', 'ورامین');
                options[80] = new Option('وهن آباد', 'وهن آباد');
            }
            if (province === '{{ $provinces[2] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('احمد سرگوراب', 'احمد سرگوراب');
                options[2] = new Option('اسالم', 'اسالم');
                options[3] = new Option('اسكلك', 'اسكلك');
                options[4] = new Option('اسلام آباد', 'اسلام آباد');
                options[5] = new Option('اطاقور', 'اطاقور');
                options[6] = new Option('املش', 'املش');
                options[7] = new Option('آبكنار', 'آبكنار');
                options[8] = new Option('آستارا', 'آستارا');
                options[9] = new Option('آستانه اشرفیه', 'آستانه اشرفیه');
                options[10] = new Option('بازاراسالم', 'بازاراسالم');
                options[11] = new Option('بازارجمعه شاندرمن', 'بازارجمعه شاندرمن');
                options[12] = new Option('برهسر', 'برهسر');
                options[13] = new Option('بلترك', 'بلترك');
                options[14] = new Option('بلسبنه', 'بلسبنه');
                options[15] = new Option('بندرانزلی', 'بندرانزلی');
                options[16] = new Option('پاشاكی', 'پاشاكی');
                options[17] = new Option('پرهسر', 'پرهسر');
                options[18] = new Option('پلاسی', 'پلاسی');
                options[19] = new Option('پونل', 'پونل');
                options[20] = new Option('پیربست لولمان', 'پیربست لولمان');
                options[21] = new Option('توتكابن', 'توتكابن');
                options[22] = new Option('جوكندان', 'جوكندان');
                options[23] = new Option('جیرنده', 'جیرنده');
                options[24] = new Option('چابكسر', 'چابكسر');
                options[25] = new Option('چاپارخانه', 'چاپارخانه');
                options[26] = new Option('چوبر', 'چوبر');
                options[27] = new Option('خاچكین', 'خاچكین');
                options[28] = new Option('خشك بیجار', 'خشك بیجار');
                options[29] = new Option('خطبه سرا', 'خطبه سرا');
                options[30] = new Option('خمام', 'خمام');
                options[31] = new Option('دیلمان', 'دیلمان');
                options[32] = new Option('رانكوه', 'رانكوه');
                options[33] = new Option('رحیم آباد', 'رحیم آباد');
                options[34] = new Option('رستم آباد', 'رستم آباد');
                options[35] = new Option('رشت', 'رشت');
                options[36] = new Option('رضوان شهر', 'رضوان شهر');
                options[37] = new Option('رودبار', 'رودبار');
                options[38] = new Option('رودسر', 'رودسر');
                options[39] = new Option('سراوان', 'سراوان');
                options[40] = new Option('سنگر', 'سنگر');
                options[41] = new Option('سیاهكل', 'سیاهكل');
                options[42] = new Option('شاندرمن', 'شاندرمن');
                options[43] = new Option('شفت', 'شفت');
                options[44] = new Option('صومعه سرا', 'صومعه سرا');
                options[45] = new Option('طاهر گوداب', 'طاهر گوداب');
                options[46] = new Option('طوللات', 'طوللات');
                options[47] = new Option('فومن', 'فومن');
                options[48] = new Option('قاسم آبادسفلی', 'قاسم آبادسفلی');
                options[49] = new Option('كپورچال', 'كپورچال');
                options[50] = new Option('كلاچای', 'كلاچای');
                options[51] = new Option('كوچصفهان', 'كوچصفهان');
                options[52] = new Option('كومله', 'كومله');
                options[53] = new Option('كیاشهر', 'كیاشهر');
                options[54] = new Option('گشت', 'گشت');
                options[55] = new Option('لاهیجان', 'لاهیجان');
                options[56] = new Option('لشت نشا', 'لشت نشا');
                options[57] = new Option('لنگرود', 'لنگرود');
                options[58] = new Option('لوشان', 'لوشان');
                options[59] = new Option('لولمان', 'لولمان');
                options[60] = new Option('لوندویل', 'لوندویل');
                options[61] = new Option('لیسار', 'لیسار');
                options[62] = new Option('ماسال', 'ماسال');
                options[63] = new Option('ماسوله', 'ماسوله');
                options[64] = new Option('منجیل', 'منجیل');
                options[65] = new Option('هشتپر ـ طوالش', 'هشتپر ـ طوالش');
                options[66] = new Option('واجارگاه', 'واجارگاه');
            }
            if (province === '{{ $provinces[3] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابشاحمد', 'ابشاحمد');
                options[2] = new Option('اذغان', 'اذغان');
                options[3] = new Option('اسب فروشان', 'اسب فروشان');
                options[4] = new Option('اسكو', 'اسكو');
                options[5] = new Option('اغچه ریش', 'اغچه ریش');
                options[6] = new Option('اقمنار', 'اقمنار');
                options[7] = new Option('القو', 'القو');
                options[8] = new Option('اهر', 'اهر');
                options[9] = new Option('ایلخچی', 'ایلخچی');
                options[10] = new Option('آذرشهر', 'آذرشهر');
                options[11] = new Option('باسمنج', 'باسمنج');
                options[12] = new Option('بخشایش ـ كلوانق', 'بخشایش ـ كلوانق');
                options[13] = new Option('بستان آباد', 'بستان آباد');
                options[14] = new Option('بناب', 'بناب');
                options[15] = new Option('بناب جدید ـ مرند', 'بناب جدید ـ مرند');
                options[16] = new Option('تبریز', 'تبریز');
                options[17] = new Option('ترك', 'ترك');
                options[18] = new Option('تسوج', 'تسوج');
                options[19] = new Option('جلفا', 'جلفا');
                options[20] = new Option('خامنه', 'خامنه');
                options[21] = new Option('خداآفرین', 'خداآفرین');
                options[22] = new Option('خسروشهر', 'خسروشهر');
                options[23] = new Option('خضرلو', 'خضرلو');
                options[24] = new Option('خلجان', 'خلجان');
                options[25] = new Option('سبلان', 'سبلان');
                options[26] = new Option('سراب', 'سراب');
                options[27] = new Option('سردرود', 'سردرود');
                options[28] = new Option('سیس', 'سیس');
                options[29] = new Option('شادبادمشایخ', 'شادبادمشایخ');
                options[30] = new Option('شبستر', 'شبستر');
                options[31] = new Option('شربیان', 'شربیان');
                options[32] = new Option('شرفخانه', 'شرفخانه');
                options[33] = new Option('شهر جدید سهند', 'شهر جدید سهند');
                options[34] = new Option('صوفیان', 'صوفیان');
                options[35] = new Option('عجب شیر', 'عجب شیر');
                options[36] = new Option('قره اغاج ـ چاراویماق', 'قره اغاج ـ چاراویماق');
                options[37] = new Option('قره بابا', 'قره بابا');
                options[38] = new Option('كردكندی', 'كردكندی');
                options[39] = new Option('كلیبر', 'كلیبر');
                options[40] = new Option('كندرود', 'كندرود');
                options[41] = new Option('كندوان', 'كندوان');
                options[42] = new Option('گوگان', 'گوگان');
                options[43] = new Option('مراغه', 'مراغه');
                options[44] = new Option('مرند', 'مرند');
                options[45] = new Option('ملكان', 'ملكان');
                options[46] = new Option('ممقان', 'ممقان');
                options[47] = new Option('میانه', 'میانه');
                options[48] = new Option('هادیشهر', 'هادیشهر');
                options[49] = new Option('هریس', 'هریس');
                options[50] = new Option('هشترود', 'هشترود');
                options[51] = new Option('هوراند', 'هوراند');
                options[52] = new Option('ورزقان', 'ورزقان');
            }
            if (province === '{{ $provinces[4] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اروندكنار', 'اروندكنار');
                options[2] = new Option('امیدیه', 'امیدیه');
                options[3] = new Option('اندیمشك', 'اندیمشك');
                options[4] = new Option('اهواز', 'اهواز');
                options[5] = new Option('ایذه', 'ایذه');
                options[6] = new Option('آبادان', 'آبادان');
                options[7] = new Option('آغاجاری', 'آغاجاری');
                options[8] = new Option('باغ ملك', 'باغ ملك');
                options[9] = new Option('بندرامام خمینی', 'بندرامام خمینی');
                options[10] = new Option('بهبهان', 'بهبهان');
                options[11] = new Option('جایزان', 'جایزان');
                options[12] = new Option('جنت مكان', 'جنت مكان');
                options[13] = new Option('چمران ـ شهرك طالقانی ', 'چمران ـ شهرك طالقانی ');
                options[14] = new Option('حمیدیه', 'حمیدیه');
                options[15] = new Option('خرمشهر', 'خرمشهر');
                options[16] = new Option('دزآب', 'دزآب');
                options[17] = new Option('دزفول', 'دزفول');
                options[18] = new Option('دهدز', 'دهدز');
                options[19] = new Option('رامشیر', 'رامشیر');
                options[20] = new Option('رامهرمز', 'رامهرمز');
                options[21] = new Option('سربندر', 'سربندر');
                options[22] = new Option('سردشت', 'سردشت');
                options[23] = new Option('سماله', 'سماله');
                options[24] = new Option('سوسنگرد ـ دشت آزادگان', 'سوسنگرد ـ دشت آزادگان');
                options[25] = new Option('شادگان', 'شادگان');
                options[26] = new Option('شرافت', 'شرافت');
                options[27] = new Option('شوش', 'شوش');
                options[28] = new Option('شوشتر', 'شوشتر');
                options[29] = new Option('شیبان', 'شیبان');
                options[30] = new Option('صالح مشطت', 'صالح مشطت');
                options[31] = new Option('كردستان بزرگ', 'كردستان بزرگ');
                options[32] = new Option('گتوند', 'گتوند');
                options[33] = new Option('لالی', 'لالی');
                options[34] = new Option('ماهشهر', 'ماهشهر');
                options[35] = new Option('مسجد سلیمان', 'مسجد سلیمان');
                options[36] = new Option('ملاثانی', 'ملاثانی');
                options[37] = new Option('میانكوه', 'میانكوه');
                options[38] = new Option('هفتگل', 'هفتگل');
                options[39] = new Option('هندیجان', 'هندیجان');
                options[40] = new Option('هویزه', 'هویزه');
                options[41] = new Option('ویس', 'ویس');
            }
            if (province === '{{ $provinces[5] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option(' بیضا', ' بیضا');
                options[2] = new Option('اردكان ـ سپیدان', 'اردكان ـ سپیدان');
                options[3] = new Option('ارسنجان', 'ارسنجان');
                options[4] = new Option('استهبان', 'استهبان');
                options[5] = new Option('اشكنان ـ اهل', 'اشكنان ـ اهل');
                options[6] = new Option('اقلید', 'اقلید');
                options[7] = new Option('اكبرآبادكوار', 'اكبرآبادكوار');
                options[8] = new Option('اوز', 'اوز');
                options[9] = new Option('ایزدخواست', 'ایزدخواست');
                options[10] = new Option('آباده', 'آباده');
                options[11] = new Option('آباده طشك', 'آباده طشك');
                options[12] = new Option('بالاده', 'بالاده');
                options[13] = new Option('بانش', 'بانش');
                options[14] = new Option('بنارویه', 'بنارویه');
                options[15] = new Option('بهمن', 'بهمن');
                options[16] = new Option('بوانات', 'بوانات');
                options[17] = new Option('بوانات(سوریان)', 'بوانات(سوریان)');
                options[18] = new Option('بیرم', 'بیرم');
                options[19] = new Option('جنت شهر(دهخیر)', 'جنت شهر(دهخیر)');
                options[20] = new Option('جهرم', 'جهرم');
                options[21] = new Option('جویم', 'جویم');
                options[22] = new Option('حاجی آباد ـ زرین دشت', 'حاجی آباد ـ زرین دشت');
                options[23] = new Option('حسن آباد', 'حسن آباد');
                options[24] = new Option('خرامه', 'خرامه');
                options[25] = new Option('خرمی', 'خرمی');
                options[26] = new Option('خشت', 'خشت');
                options[27] = new Option('خنج', 'خنج');
                options[28] = new Option('خیرآبادتوللی', 'خیرآبادتوللی');
                options[29] = new Option('داراب', 'داراب');
                options[30] = new Option('داریان', 'داریان');
                options[31] = new Option('دهرم', 'دهرم');
                options[32] = new Option('رونیز ', 'رونیز ');
                options[33] = new Option('زاهدشهر', 'زاهدشهر');
                options[34] = new Option('زرقان', 'زرقان');
                options[35] = new Option('سروستان', 'سروستان');
                options[36] = new Option('سعادت شهر ـ پاسارگاد', 'سعادت شهر ـ پاسارگاد');
                options[37] = new Option('سیدان', 'سیدان');
                options[38] = new Option('ششده', 'ششده');
                options[39] = new Option('شهر جدید صدرا', 'شهر جدید صدرا');
                options[40] = new Option('شیراز', 'شیراز');
                options[41] = new Option('صغاد', 'صغاد');
                options[42] = new Option('صفاشهر ـ خرم بید', 'صفاشهر ـ خرم بید');
                options[43] = new Option('طسوج', 'طسوج');
                options[44] = new Option('علاءمرودشت', 'علاءمرودشت');
                options[45] = new Option('فدامی', 'فدامی');
                options[46] = new Option('فراشبند', 'فراشبند');
                options[47] = new Option('فسا', 'فسا');
                options[48] = new Option('فیروزآباد', 'فیروزآباد');
                options[49] = new Option('فیشور', 'فیشور');
                options[50] = new Option('قادرآباد', 'قادرآباد');
                options[51] = new Option('قائمیه', 'قائمیه');
                options[52] = new Option('قطب آباد', 'قطب آباد');
                options[53] = new Option('قطرویه', 'قطرویه');
                options[54] = new Option('قیر و كارزین', 'قیر و كارزین');
                options[55] = new Option('كازرون', 'كازرون');
                options[56] = new Option('كام فیروز', 'كام فیروز');
                options[57] = new Option('كلانی', 'كلانی');
                options[58] = new Option('كنارتخته', 'كنارتخته');
                options[59] = new Option('كوار', 'كوار');
                options[60] = new Option('گراش', 'گراش');
                options[61] = new Option('گویم', 'گویم');
                options[62] = new Option('لار ـ لارستان', 'لار ـ لارستان');
                options[63] = new Option('لامرد', 'لامرد');
                options[64] = new Option('مبارك آباد', 'مبارك آباد');
                options[65] = new Option('مرودشت', 'مرودشت');
                options[66] = new Option('مشكان', 'مشكان');
                options[67] = new Option('مصیری ـ رستم', 'مصیری ـ رستم');
                options[68] = new Option('مظفری', 'مظفری');
                options[69] = new Option('مهر', 'مهر');
                options[70] = new Option('میمند', 'میمند');
                options[71] = new Option('نورآباد ـ ممسنی', 'نورآباد ـ ممسنی');
                options[72] = new Option('نی ریز', 'نی ریز');
                options[73] = new Option('وراوی', 'وراوی');
            }
            if (province === '{{ $provinces[6] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابریشم', 'ابریشم');
                options[2] = new Option('ابوزیدآباد', 'ابوزیدآباد');
                options[3] = new Option('اردستان', 'اردستان');
                options[4] = new Option('اریسمان', 'اریسمان');
                options[5] = new Option('اژیه', 'اژیه');
                options[6] = new Option('اسفرجان', 'اسفرجان');
                options[7] = new Option('اسلام آباد', 'اسلام آباد');
                options[8] = new Option('اشن', 'اشن');
                options[9] = new Option('اصغرآباد', 'اصغرآباد');
                options[10] = new Option('اصفهان', 'اصفهان');
                options[11] = new Option('امین آباد', 'امین آباد');
                options[12] = new Option('ایمان شهر', 'ایمان شهر');
                options[13] = new Option('آران وبیدگل', 'آران وبیدگل');
                options[14] = new Option('بادرود', 'بادرود');
                options[15] = new Option('باغ بهادران', 'باغ بهادران');
                options[16] = new Option('بهارستان', 'بهارستان');
                options[17] = new Option('بوئین ومیاندشت', 'بوئین ومیاندشت');
                options[18] = new Option('پیربكران', 'پیربكران');
                options[19] = new Option('تودشك', 'تودشك');
                options[20] = new Option('تیران', 'تیران');
                options[21] = new Option('جعفرآباد', 'جعفرآباد');
                options[22] = new Option('جندق', 'جندق');
                options[23] = new Option('جوجیل', 'جوجیل');
                options[24] = new Option('چادگان', 'چادگان');
                options[25] = new Option('چرمهین', 'چرمهین');
                options[26] = new Option('چمگردان', 'چمگردان');
                options[27] = new Option('حسن اباد', 'حسن اباد');
                options[28] = new Option('خالدآباد', 'خالدآباد');
                options[29] = new Option('خمینی شهر', 'خمینی شهر');
                options[30] = new Option('خوانسار', 'خوانسار');
                options[31] = new Option('خوانسارك', 'خوانسارك');
                options[32] = new Option('خور', 'خور');
                options[33] = new Option('خوراسگان', 'خوراسگان');
                options[34] = new Option('خورزوق', 'خورزوق');
                options[35] = new Option('داران ـ فریدن', 'داران ـ فریدن');
                options[36] = new Option('درچه پیاز', 'درچه پیاز');
                options[37] = new Option('دستگردوبرخوار', 'دستگردوبرخوار');
                options[38] = new Option('دهاقان', 'دهاقان');
                options[39] = new Option('دهق', 'دهق');
                options[40] = new Option('دولت آباد', 'دولت آباد');
                options[41] = new Option('دیزیچه', 'دیزیچه');
                options[42] = new Option('رزوه', 'رزوه');
                options[43] = new Option('رضوان شهر', 'رضوان شهر');
                options[44] = new Option('رهنان', 'رهنان');
                options[45] = new Option('زاینده رود', 'زاینده رود');
                options[46] = new Option('زرین شهر ـ لنجان', 'زرین شهر ـ لنجان');
                options[47] = new Option('زواره', 'زواره');
                options[48] = new Option('زیار', 'زیار');
                options[49] = new Option('زیبا شهر', 'زیبا شهر');
                options[50] = new Option('سپاهان شهر', 'سپاهان شهر');
                options[51] = new Option('سده لنجان', 'سده لنجان');
                options[52] = new Option('سمیرم', 'سمیرم');
                options[53] = new Option('شاهین شهر', 'شاهین شهر');
                options[54] = new Option('شهرضا', 'شهرضا');
                options[55] = new Option('شهرك صنعتی مورچ', 'شهرك صنعتی مورچ');
                options[56] = new Option('شهرك مجلسی', 'شهرك مجلسی');
                options[57] = new Option('شهرک صنعتی محمودآباد', 'شهرک صنعتی محمودآباد');
                options[58] = new Option('طالخونچه', 'طالخونچه');
                options[59] = new Option('عسگران', 'عسگران');
                options[60] = new Option('علویچه', 'علویچه');
                options[61] = new Option('غرغن', 'غرغن');
                options[62] = new Option('فرخی', 'فرخی');
                options[63] = new Option('فریدون شهر', 'فریدون شهر');
                options[64] = new Option('فلاورجان', 'فلاورجان');
                options[65] = new Option('فولادشهر', 'فولادشهر');
                options[66] = new Option('فولادمباركه', 'فولادمباركه');
                options[67] = new Option('قهد ریجان', 'قهد ریجان');
                options[68] = new Option('كاشان', 'كاشان');
                options[69] = new Option('كلیشادوسودرجان', 'كلیشادوسودرجان');
                options[70] = new Option('كمشچه', 'كمشچه');
                options[71] = new Option('كوهپایه', 'كوهپایه');
                options[72] = new Option('گز', 'گز');
                options[73] = new Option('گلپایگان', 'گلپایگان');
                options[74] = new Option('گلدشت', 'گلدشت');
                options[75] = new Option('گلشهر', 'گلشهر');
                options[76] = new Option('گوگد', 'گوگد');
                options[77] = new Option('مباركه', 'مباركه');
                options[78] = new Option('مهاباد', 'مهاباد');
                options[79] = new Option('مورچه خورت', 'مورچه خورت');
                options[80] = new Option('میمه', 'میمه');
                options[81] = new Option('نائین', 'نائین');
                options[82] = new Option('نجف آباد', 'نجف آباد');
                options[83] = new Option('نصر آباد', 'نصر آباد');
                options[84] = new Option('نطنز', 'نطنز');
                options[85] = new Option('نیك آباد', 'نیك آباد');
                options[86] = new Option('بهارستان', 'بهارستان');
                options[87] = new Option('هرند', 'هرند');
                options[88] = new Option('ورزنه', 'ورزنه');
                options[89] = new Option('ورنامخواست', 'ورنامخواست');
                options[90] = new Option('ویلاشهر', 'ویلاشهر');
            }
            if (province === '{{ $provinces[7] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابدال آباد', 'ابدال آباد');
                options[2] = new Option('ازادوار', 'ازادوار');
                options[3] = new Option('باجگیران', 'باجگیران');
                options[4] = new Option('باخرز', 'باخرز');
                options[5] = new Option('باسفر', 'باسفر');
                options[6] = new Option('بجستان', 'بجستان');
                options[7] = new Option('بردسكن', 'بردسكن');
                options[8] = new Option('برون', 'برون');
                options[9] = new Option('بزنگان', 'بزنگان');
                options[10] = new Option('بند قرائ', 'بند قرائ');
                options[11] = new Option('بیدخت', 'بیدخت');
                options[12] = new Option('تایباد', 'تایباد');
                options[13] = new Option('تربت جام', 'تربت جام');
                options[14] = new Option('تربت حیدریه', 'تربت حیدریه');
                options[15] = new Option('جغتای', 'جغتای');
                options[16] = new Option('جنگل', 'جنگل');
                options[17] = new Option('چمن آباد', 'چمن آباد');
                options[18] = new Option('چناران', 'چناران');
                options[19] = new Option('خلیل آباد', 'خلیل آباد');
                options[20] = new Option('خواف', 'خواف');
                options[21] = new Option('داورزن', 'داورزن');
                options[22] = new Option('درگز', 'درگز');
                options[23] = new Option('دولت آباد ـ زاوه', 'دولت آباد ـ زاوه');
                options[24] = new Option('رادكان', 'رادكان');
                options[25] = new Option('رشتخوار', 'رشتخوار');
                options[26] = new Option('رضویه', 'رضویه');
                options[27] = new Option('ریوش(كوهسرخ)', 'ریوش(كوهسرخ)');
                options[28] = new Option('سبزوار', 'سبزوار');
                options[29] = new Option('سرخس', 'سرخس');
                options[30] = new Option('سلطان آباد', 'سلطان آباد');
                options[31] = new Option('سنگان', 'سنگان');
                options[32] = new Option('شاندیز', 'شاندیز');
                options[33] = new Option('صالح آباد', 'صالح آباد');
                options[34] = new Option('طرقبه ـ بینالود', 'طرقبه ـ بینالود');
                options[35] = new Option('طوس سفلی', 'طوس سفلی');
                options[36] = new Option('فریمان', 'فریمان');
                options[37] = new Option('فیروزه ـ تخت جلگه', 'فیروزه ـ تخت جلگه');
                options[38] = new Option('فیض آباد ـ مه ولات', 'فیض آباد ـ مه ولات');
                options[39] = new Option('قاسم آباد', 'قاسم آباد');
                options[40] = new Option('قدمگاه', 'قدمگاه');
                options[41] = new Option('قوچان', 'قوچان');
                options[42] = new Option('كاخك', 'كاخك');
                options[43] = new Option('كاشمر', 'كاشمر');
                options[44] = new Option('كلات', 'كلات');
                options[45] = new Option('گلبهار', 'گلبهار');
                options[46] = new Option('گناباد', 'گناباد');
                options[47] = new Option('لطف آباد', 'لطف آباد');
                options[48] = new Option('مشهد', 'مشهد');
                options[49] = new Option('مشهدریزه', 'مشهدریزه');
                options[50] = new Option('مصعبی', 'مصعبی');
                options[51] = new Option('نشتیفان', 'نشتیفان');
                options[52] = new Option('نقاب ـ جوین', 'نقاب ـ جوین');
                options[53] = new Option('نیشابور', 'نیشابور');
                options[54] = new Option('نیل شهر', 'نیل شهر');
            }
            if (province === '{{ $provinces[8] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('َآوج', 'َآوج');
                options[2] = new Option('ارداق', 'ارداق');
                options[3] = new Option('اسفرورین', 'اسفرورین');
                options[4] = new Option('اقبالیه', 'اقبالیه');
                options[5] = new Option('الوند ـ البرز', 'الوند ـ البرز');
                options[6] = new Option('آبگرم', 'آبگرم');
                options[7] = new Option('آبیك', 'آبیك');
                options[8] = new Option('آقابابا', 'آقابابا');
                options[9] = new Option('بوئین زهرا', 'بوئین زهرا');
                options[10] = new Option('بیدستان', 'بیدستان');
                options[11] = new Option('تاكستان', 'تاكستان');
                options[12] = new Option('حصارولیعصر', 'حصارولیعصر');
                options[13] = new Option('خاكعلی', 'خاكعلی');
                options[14] = new Option('خرم دشت', 'خرم دشت');
                options[15] = new Option('دانسفهان', 'دانسفهان');
                options[16] = new Option('سیردان', 'سیردان');
                options[17] = new Option('شال', 'شال');
                options[18] = new Option('شهر صنعتی البرز', 'شهر صنعتی البرز');
                options[19] = new Option('ضیاآباد', 'ضیاآباد');
                options[20] = new Option('قزوین', 'قزوین');
                options[21] = new Option('لیا', 'لیا');
                options[22] = new Option('محمدیه', 'محمدیه');
                options[23] = new Option('محمود آباد نمونه', 'محمود آباد نمونه');
                options[24] = new Option('معلم كلایه', 'معلم كلایه');
                options[25] = new Option('نرجه', 'نرجه');
            }
            if (province === '{{ $provinces[9] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ارادان', 'ارادان');
                options[2] = new Option('امیریه', 'امیریه');
                options[3] = new Option('ایوانكی', 'ایوانكی');
                options[4] = new Option('بسطام', 'بسطام');
                options[5] = new Option('بیارجمند', 'بیارجمند');
                options[6] = new Option('خیرآباد', 'خیرآباد');
                options[7] = new Option('دامغان', 'دامغان');
                options[8] = new Option('درجزین', 'درجزین');
                options[9] = new Option('سرخه', 'سرخه');
                options[10] = new Option('سمنان', 'سمنان');
                options[11] = new Option('شاهرود', 'شاهرود');
                options[12] = new Option('شهمیرزاد', 'شهمیرزاد');
                options[13] = new Option('گرمسار', 'گرمسار');
                options[14] = new Option('مجن', 'مجن');
                options[15] = new Option('مهدی شهر', 'مهدی شهر');
                options[16] = new Option('میامی', 'میامی');
                options[17] = new Option('میغان', 'میغان');
            }
            if (province === '{{ $provinces[10] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('دستجرد', 'دستجرد');
                options[2] = new Option('سلفچگان', 'سلفچگان');
                options[3] = new Option('شهر جعفریه', 'شهر جعفریه');
                options[4] = new Option('قم', 'قم');
                options[5] = new Option('قنوات', 'قنوات');
                options[6] = new Option('كهك', 'كهك');
            }
            if (province === '{{ $provinces[11] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اراك', 'اراك');
                options[2] = new Option('آستانه', 'آستانه');
                options[3] = new Option('آشتیان', 'آشتیان');
                options[4] = new Option('تفرش', 'تفرش');
                options[5] = new Option('توره', 'توره');
                options[6] = new Option('جاورسیان', 'جاورسیان');
                options[7] = new Option('خسروبیك', 'خسروبیك');
                options[8] = new Option('خشك رود', 'خشك رود');
                options[9] = new Option('خمین', 'خمین');
                options[10] = new Option('خنداب', 'خنداب');
                options[11] = new Option('دلیجان', 'دلیجان');
                options[12] = new Option('ریحان علیا', 'ریحان علیا');
                options[13] = new Option('زاویه', 'زاویه');
                options[14] = new Option('ساوه', 'ساوه');
                options[15] = new Option('شازند', 'شازند');
                options[16] = new Option('شهراب', 'شهراب');
                options[17] = new Option('شهرك مهاجران', 'شهرك مهاجران');
                options[18] = new Option('فرمهین', 'فرمهین');
                options[19] = new Option('كمیجان', 'كمیجان');
                options[20] = new Option('مامونیه ـ زرندیه', 'مامونیه ـ زرندیه');
                options[21] = new Option('محلات', 'محلات');
                options[22] = new Option('میلاجرد', 'میلاجرد');
                options[23] = new Option('هندودر', 'هندودر');
            }
            if (province === '{{ $provinces[12] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option(' آب بر ـ طارم', ' آب بر ـ طارم');
                options[2] = new Option('ابهر', 'ابهر');
                options[3] = new Option('اسفجین', 'اسفجین');
                options[4] = new Option('پری', 'پری');
                options[5] = new Option('حلب', 'حلب');
                options[6] = new Option('خرمدره', 'خرمدره');
                options[7] = new Option('دستجرده', 'دستجرده');
                options[8] = new Option('دندی', 'دندی');
                options[9] = new Option('زرین آباد ـ ایجرود', 'زرین آباد ـ ایجرود');
                options[10] = new Option('زرین رود', 'زرین رود');
                options[11] = new Option('زنجان', 'زنجان');
                options[12] = new Option('سلطانیه', 'سلطانیه');
                options[13] = new Option('صائین قلعه', 'صائین قلعه');
                options[14] = new Option('قیدار', 'قیدار');
                options[15] = new Option('گرماب', 'گرماب');
                options[16] = new Option('گیلوان', 'گیلوان');
                options[17] = new Option('ماهنشان', 'ماهنشان');
                options[18] = new Option('همایون', 'همایون');
                options[19] = new Option('هیدج', 'هیدج');
            }
            if (province === '{{ $provinces[13] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اسلام آباد', 'اسلام آباد');
                options[2] = new Option('امیركلا', 'امیركلا');
                options[3] = new Option('ایزدشهر', 'ایزدشهر');
                options[4] = new Option('آمل', 'آمل');
                options[5] = new Option('آهنگركلا', 'آهنگركلا');
                options[6] = new Option('بابل', 'بابل');
                options[7] = new Option('بابلسر', 'بابلسر');
                options[8] = new Option('بلده', 'بلده');
                options[9] = new Option('بهشهر', 'بهشهر');
                options[10] = new Option('بهنمیر', 'بهنمیر');
                options[11] = new Option('پل سفید ـ سوادكوه', 'پل سفید ـ سوادكوه');
                options[12] = new Option('تنكابن', 'تنكابن');
                options[13] = new Option('جویبار', 'جویبار');
                options[14] = new Option('چالوس', 'چالوس');
                options[15] = new Option('چمستان', 'چمستان');
                options[16] = new Option('خرم آباد', 'خرم آباد');
                options[17] = new Option('خوشرودپی', 'خوشرودپی');
                options[18] = new Option('رامسر', 'رامسر');
                options[19] = new Option('رستم كلا', 'رستم كلا');
                options[20] = new Option('رویانشهر', 'رویانشهر');
                options[21] = new Option('زاغمرز', 'زاغمرز');
                options[22] = new Option('زرگر محله', 'زرگر محله');
                options[23] = new Option('زیرآب', 'زیرآب');
                options[24] = new Option('سادات محله', 'سادات محله');
                options[25] = new Option('ساری', 'ساری');
                options[26] = new Option('سرخرود', 'سرخرود');
                options[27] = new Option('سلمانشهر', 'سلمانشهر');
                options[28] = new Option('سنگده', 'سنگده');
                options[29] = new Option('سوا', 'سوا');
                options[30] = new Option('سورك', 'سورك');
                options[31] = new Option('شیرگاه', 'شیرگاه');
                options[32] = new Option('شیرود', 'شیرود');
                options[33] = new Option('عباس آباد', 'عباس آباد');
                options[34] = new Option('فریدون كنار', 'فریدون كنار');
                options[35] = new Option('قائم شهر', 'قائم شهر');
                options[36] = new Option('كلارآباد', 'كلارآباد');
                options[37] = new Option('كلاردشت', 'كلاردشت');
                options[38] = new Option('كیا كلا', 'كیا كلا');
                options[39] = new Option('كیاسر', 'كیاسر');
                options[40] = new Option('گزنك', 'گزنك');
                options[41] = new Option('گلوگاه', 'گلوگاه');
                options[42] = new Option('گهرباران', 'گهرباران');
                options[43] = new Option('محمودآباد', 'محمودآباد');
                options[44] = new Option('مرزن آباد', 'مرزن آباد');
                options[45] = new Option('مرزی كلا', 'مرزی كلا');
                options[46] = new Option('نشتارود', 'نشتارود');
                options[47] = new Option('نكاء', 'نكاء');
                options[48] = new Option('نور', 'نور');
                options[49] = new Option('نوشهر', 'نوشهر');
            }
            if (province === '{{ $provinces[14] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('انبار آلوم', 'انبار آلوم');
                options[2] = new Option('اینچه برون', 'اینچه برون');
                options[3] = new Option('آزادشهر', 'آزادشهر');
                options[4] = new Option('آق قلا', 'آق قلا');
                options[5] = new Option('بندر گز', 'بندر گز');
                options[6] = new Option('بندرتركمن', 'بندرتركمن');
                options[7] = new Option('جلین', 'جلین');
                options[8] = new Option('خان ببین', 'خان ببین');
                options[9] = new Option('رامیان', 'رامیان');
                options[10] = new Option('سیمین شهر', 'سیمین شهر');
                options[11] = new Option('علی آباد', 'علی آباد');
                options[12] = new Option('فاضل آباد', 'فاضل آباد');
                options[13] = new Option('كردكوی', 'كردكوی');
                options[14] = new Option('كلاله', 'كلاله');
                options[15] = new Option('گالیكش', 'گالیكش');
                options[16] = new Option('گرگان', 'گرگان');
                options[17] = new Option('گمیش تپه', 'گمیش تپه');
                options[18] = new Option('گنبدكاوس', 'گنبدكاوس');
                options[19] = new Option('مراوه تپه', 'مراوه تپه');
                options[20] = new Option('مینودشت', 'مینودشت');
            }
            if (province === '{{ $provinces[15] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابی بیگلو', 'ابی بیگلو');
                options[2] = new Option('اردبیل', 'اردبیل');
                options[3] = new Option('اصلاندوز', 'اصلاندوز');
                options[4] = new Option('بیله سوار', 'بیله سوار');
                options[5] = new Option('پارس آباد', 'پارس آباد');
                options[6] = new Option('تازه كند انگوت', 'تازه كند انگوت');
                options[7] = new Option('جعفرآباد', 'جعفرآباد');
                options[8] = new Option('خلخال', 'خلخال');
                options[9] = new Option('سرعین', 'سرعین');
                options[10] = new Option('شهرك شهید غفاری', 'شهرك شهید غفاری');
                options[11] = new Option('كلور', 'كلور');
                options[12] = new Option('كوارئیم', 'كوارئیم');
                options[13] = new Option('گرمی ', 'گرمی ');
                options[14] = new Option('گیوی ـ كوثر', 'گیوی ـ كوثر');
                options[15] = new Option('لاهرود', 'لاهرود');
                options[16] = new Option('مشگین شهر', 'مشگین شهر');
                options[17] = new Option('نمین', 'نمین');
                options[18] = new Option('نیر', 'نیر');
                options[19] = new Option('هشتجین', 'هشتجین');
            }
            if (province === '{{ $provinces[16] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ارومیه', 'ارومیه');
                options[2] = new Option('اشنویه', 'اشنویه');
                options[3] = new Option('ایواوغلی', 'ایواوغلی');
                options[4] = new Option('بازرگان', 'بازرگان');
                options[5] = new Option('بوكان', 'بوكان');
                options[6] = new Option('پسوه', 'پسوه');
                options[7] = new Option('پلدشت', 'پلدشت');
                options[8] = new Option('پیرانشهر', 'پیرانشهر');
                options[9] = new Option('تازه شهر', 'تازه شهر');
                options[10] = new Option('تكاب', 'تكاب');
                options[11] = new Option('چهاربرج قدیم', 'چهاربرج قدیم');
                options[12] = new Option('خوی', 'خوی');
                options[13] = new Option('دیزج', 'دیزج');
                options[14] = new Option('دیزجدیز', 'دیزجدیز');
                options[15] = new Option('ربط', 'ربط');
                options[16] = new Option('زیوه', 'زیوه');
                options[17] = new Option('سردشت', 'سردشت');
                options[18] = new Option('سلماس', 'سلماس');
                options[19] = new Option('سیلوانا', 'سیلوانا');
                options[20] = new Option('سیلوه', 'سیلوه');
                options[21] = new Option('سیه چشمه ـ چالدران', 'سیه چشمه ـ چالدران');
                options[22] = new Option('شاهین دژ', 'شاهین دژ');
                options[23] = new Option('شوط', 'شوط');
                options[24] = new Option('قره ضیاء الدین ـ چایپاره', 'قره ضیاء الدین ـ چایپاره');
                options[25] = new Option('قوشچی', 'قوشچی');
                options[26] = new Option('كشاورز (اقبال)', 'كشاورز (اقبال)');
                options[27] = new Option('ماكو', 'ماكو');
                options[28] = new Option('محمد یار', 'محمد یار');
                options[29] = new Option('محمودآباد', 'محمودآباد');
                options[30] = new Option('مهاباد', 'مهاباد');
                options[31] = new Option('میاندوآب', 'میاندوآب');
                options[32] = new Option('میاوق', 'میاوق');
                options[33] = new Option('میرآباد', 'میرآباد');
                options[34] = new Option('نقده', 'نقده');
                options[35] = new Option('نوشین شهر', 'نوشین شهر');
            }
            if (province === '{{ $provinces[17] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ازندریان', 'ازندریان');
                options[2] = new Option('اسدآباد', 'اسدآباد');
                options[3] = new Option('اسلام آباد', 'اسلام آباد');
                options[4] = new Option('بهار', 'بهار');
                options[5] = new Option('پایگاه نوژه', 'پایگاه نوژه');
                options[6] = new Option('تویسركان', 'تویسركان');
                options[7] = new Option('دمق', 'دمق');
                options[8] = new Option('رزن', 'رزن');
                options[9] = new Option('سامن', 'سامن');
                options[10] = new Option('سركان', 'سركان');
                options[11] = new Option('شیرین سو', 'شیرین سو');
                options[12] = new Option('صالح آباد', 'صالح آباد');
                options[13] = new Option('فامنین', 'فامنین');
                options[14] = new Option('قروه درجزین', 'قروه درجزین');
                options[15] = new Option('قهاوند', 'قهاوند');
                options[16] = new Option('كبودرآهنگ', 'كبودرآهنگ');
                options[17] = new Option('گیان', 'گیان');
                options[18] = new Option('لالجین', 'لالجین');
                options[19] = new Option('ملایر', 'ملایر');
                options[20] = new Option('نهاوند', 'نهاوند');
                options[21] = new Option('همدان', 'همدان');
            }
            if (province === '{{ $provinces[18] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اورامانتخت', 'اورامانتخت');
                options[2] = new Option('بانه', 'بانه');
                options[3] = new Option('بلبان آباد', 'بلبان آباد');
                options[4] = new Option('بیجار', 'بیجار');
                options[5] = new Option('دلبران', 'دلبران');
                options[6] = new Option('دهگلان', 'دهگلان');
                options[7] = new Option('دیواندره', 'دیواندره');
                options[8] = new Option('سروآباد', 'سروآباد');
                options[9] = new Option('سریش آباد', 'سریش آباد');
                options[10] = new Option('سقز', 'سقز');
                options[11] = new Option('سنندج', 'سنندج');
                options[12] = new Option('قروه', 'قروه');
                options[13] = new Option('كامیاران', 'كامیاران');
                options[14] = new Option('مریوان', 'مریوان');
                options[15] = new Option('موچش', 'موچش');
            }
            if (province === '{{ $provinces[19] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اسلام آباد غرب', 'اسلام آباد غرب');
                options[2] = new Option('باینگان', 'باینگان');
                options[3] = new Option('بیستون', 'بیستون');
                options[4] = new Option('پاوه', 'پاوه');
                options[5] = new Option('تازه آباد ـ ثلاث باباجانی', 'تازه آباد ـ ثلاث باباجانی');
                options[6] = new Option('جوانرود', 'جوانرود');
                options[7] = new Option('روانسر', 'روانسر');
                options[8] = new Option('ریجاب', 'ریجاب');
                options[9] = new Option('سراب ذهاب', 'سراب ذهاب');
                options[10] = new Option('سرپل ذهاب', 'سرپل ذهاب');
                options[11] = new Option('سنقر', 'سنقر');
                options[12] = new Option('صحنه', 'صحنه');
                options[13] = new Option('فرامان', 'فرامان');
                options[14] = new Option('فش', 'فش');
                options[15] = new Option('قصرشیرین', 'قصرشیرین');
                options[16] = new Option('كرمانشاه', 'كرمانشاه');
                options[17] = new Option('كنگاور', 'كنگاور');
                options[18] = new Option('گیلانغرب', 'گیلانغرب');
                options[19] = new Option('نودشه', 'نودشه');
                options[20] = new Option('هرسین', 'هرسین');
                options[21] = new Option('هلشی', 'هلشی');
            }
            if (province === '{{ $provinces[20] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ازنا', 'ازنا');
                options[2] = new Option('الشتر ـ سلسله', 'الشتر ـ سلسله');
                options[3] = new Option('الیگودرز', 'الیگودرز');
                options[4] = new Option('برخوردار', 'برخوردار');
                options[5] = new Option('بروجرد', 'بروجرد');
                options[6] = new Option('پل دختر', 'پل دختر');
                options[7] = new Option('تقی آباد', 'تقی آباد');
                options[8] = new Option('چغلوندی', 'چغلوندی');
                options[9] = new Option('چقابل', 'چقابل');
                options[10] = new Option('خرم آباد', 'خرم آباد');
                options[11] = new Option('دورود', 'دورود');
                options[12] = new Option('زاغه', 'زاغه');
                options[13] = new Option('سپیددشت', 'سپیددشت');
                options[14] = new Option('شول آباد', 'شول آباد');
                options[15] = new Option('كونانی', 'كونانی');
                options[16] = new Option('كوهدشت', 'كوهدشت');
                options[17] = new Option('معمولان', 'معمولان');
                options[18] = new Option('نورآباد ـ دلفان', 'نورآباد ـ دلفان');
                options[19] = new Option('واشیان نصیرتپه', 'واشیان نصیرتپه');
            }
            if (province === '{{ $provinces[21] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابدان', 'ابدان');
                options[2] = new Option('اهرم ـ تنگستان', 'اهرم ـ تنگستان');
                options[3] = new Option('آباد', 'آباد');
                options[4] = new Option('آبپخش', 'آبپخش');
                options[5] = new Option('بادوله', 'بادوله');
                options[6] = new Option('برازجان ـ دشتستان', 'برازجان ـ دشتستان');
                options[7] = new Option('بردخون', 'بردخون');
                options[8] = new Option('بندردیر', 'بندردیر');
                options[9] = new Option('بندردیلم', 'بندردیلم');
                options[10] = new Option('بندرریگ', 'بندرریگ');
                options[11] = new Option('بندركنگان', 'بندركنگان');
                options[12] = new Option('بندرگناوه', 'بندرگناوه');
                options[13] = new Option('بوشهر', 'بوشهر');
                options[14] = new Option('تنگ ارم', 'تنگ ارم');
                options[15] = new Option('جزیره خارك', 'جزیره خارك');
                options[16] = new Option('جم', 'جم');
                options[17] = new Option('چغارك', 'چغارك');
                options[18] = new Option('خورموج ـ دشتی', 'خورموج ـ دشتی');
                options[19] = new Option('دلوار', 'دلوار');
                options[20] = new Option('ریز', 'ریز');
                options[21] = new Option('سعدآباد', 'سعدآباد');
                options[22] = new Option('شبانكاره', 'شبانكاره');
                options[23] = new Option('شنبه', 'شنبه');
                options[24] = new Option('شول', 'شول');
                options[25] = new Option('عالی شهر', 'عالی شهر');
                options[26] = new Option('عسلویه', 'عسلویه');
                options[27] = new Option('كاكی', 'كاكی');
                options[28] = new Option('كلمه', 'كلمه');
                options[29] = new Option('نخل تقی', 'نخل تقی');
                options[30] = new Option('وحدتیه', 'وحدتیه');
            }
            if (province === '{{ $provinces[22] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اختیارآباد', 'اختیارآباد');
                options[2] = new Option('ارزوئیه', 'ارزوئیه');
                options[3] = new Option('امین شهر', 'امین شهر');
                options[4] = new Option('انار', 'انار');
                options[5] = new Option('باغین', 'باغین');
                options[6] = new Option('بافت', 'بافت');
                options[7] = new Option('بردسیر', 'بردسیر');
                options[8] = new Option('بلوك', 'بلوك');
                options[9] = new Option('بم', 'بم');
                options[10] = new Option('بهرمان', 'بهرمان');
                options[11] = new Option('پاریز', 'پاریز');
                options[12] = new Option('جوادیه فلاح', 'جوادیه فلاح');
                options[13] = new Option('جوشان', 'جوشان');
                options[14] = new Option('جیرفت', 'جیرفت');
                options[15] = new Option('چترود', 'چترود');
                options[16] = new Option('خانوك', 'خانوك');
                options[17] = new Option('دوساری', 'دوساری');
                options[18] = new Option('رابر', 'رابر');
                options[19] = new Option('راور', 'راور');
                options[20] = new Option('راین', 'راین');
                options[21] = new Option('رفسنجان', 'رفسنجان');
                options[22] = new Option('رودبار', 'رودبار');
                options[23] = new Option('ریگان', 'ریگان');
                options[24] = new Option('زرند', 'زرند');
                options[25] = new Option('زنگی آباد', 'زنگی آباد');
                options[26] = new Option('سرچشمه', 'سرچشمه');
                options[27] = new Option('سریز', 'سریز');
                options[28] = new Option('سیرجان', 'سیرجان');
                options[29] = new Option('شهربابك', 'شهربابك');
                options[30] = new Option('صفائیه', 'صفائیه');
                options[31] = new Option('عنبرآباد', 'عنبرآباد');
                options[32] = new Option('فاریاب', 'فاریاب');
                options[33] = new Option('فهرج', 'فهرج');
                options[34] = new Option('قلعه گنج', 'قلعه گنج');
                options[35] = new Option('كاظم آباد', 'كاظم آباد');
                options[36] = new Option('كرمان', 'كرمان');
                options[37] = new Option('كهنوج', 'كهنوج');
                options[38] = new Option('كهنوج( مغزآباد)', 'كهنوج( مغزآباد)');
                options[39] = new Option('كوهبنان', 'كوهبنان');
                options[40] = new Option('كیان شهر', 'كیان شهر');
                options[41] = new Option('گلباف', 'گلباف');
                options[42] = new Option('ماهان', 'ماهان');
                options[43] = new Option('محمدآباد ـ ریگان', 'محمدآباد ـ ریگان');
                options[44] = new Option('محی آباد', 'محی آباد');
                options[45] = new Option('منوجان', 'منوجان');
                options[46] = new Option('نجف شهر', 'نجف شهر');
                options[47] = new Option('نگار', 'نگار');
            }
            if (province === '{{ $provinces[23] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابوموسی', 'ابوموسی');
                options[2] = new Option('ایسین', 'ایسین');
                options[3] = new Option('بستك', 'بستك');
                options[4] = new Option('بندرخمیر', 'بندرخمیر');
                options[5] = new Option('بندرعباس', 'بندرعباس');
                options[6] = new Option('بندرلنگه', 'بندرلنگه');
                options[7] = new Option('بندزك كهنه', 'بندزك كهنه');
                options[8] = new Option('پارسیان', 'پارسیان');
                options[9] = new Option('پدل', 'پدل');
                options[10] = new Option('پل شرقی', 'پل شرقی');
                options[11] = new Option('تیاب', 'تیاب');
                options[12] = new Option('جاسك', 'جاسك');
                options[13] = new Option('جزیره سیری', 'جزیره سیری');
                options[14] = new Option('جزیره لاوان', 'جزیره لاوان');
                options[15] = new Option('جزیره هنگام', 'جزیره هنگام');
                options[16] = new Option('جزیرهلارك', 'جزیرهلارك');
                options[17] = new Option('جناح', 'جناح');
                options[18] = new Option('چارك', 'چارك');
                options[19] = new Option('حاجی آباد', 'حاجی آباد');
                options[20] = new Option('درگهان', 'درگهان');
                options[21] = new Option('دشتی', 'دشتی');
                options[22] = new Option('دهبارز ـ رودان', 'دهبارز ـ رودان');
                options[23] = new Option('رویدر', 'رویدر');
                options[24] = new Option('زیارت علی', 'زیارت علی');
                options[25] = new Option('سردشت ـ بشاگرد', 'سردشت ـ بشاگرد');
                options[26] = new Option('سندرك', 'سندرك');
                options[27] = new Option('سیریك', 'سیریك');
                options[28] = new Option('فارغان', 'فارغان');
                options[29] = new Option('فین', 'فین');
                options[30] = new Option('قشم', 'قشم');
                options[31] = new Option('كنگ', 'كنگ');
                options[32] = new Option('كیش', 'كیش');
                options[33] = new Option('میناب', 'میناب');
            }
            if (province === '{{ $provinces[24] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اردل', 'اردل');
                options[2] = new Option('آلونی', 'آلونی');
                options[3] = new Option('باباحیدر', 'باباحیدر');
                options[4] = new Option('بروجن', 'بروجن');
                options[5] = new Option('بلداجی', 'بلداجی');
                options[6] = new Option('بن', 'بن');
                options[7] = new Option('جونقان', 'جونقان');
                options[8] = new Option('چالشتر', 'چالشتر');
                options[9] = new Option('چلگرد ـ كوهرنگ', 'چلگرد ـ كوهرنگ');
                options[10] = new Option('دزك', 'دزك');
                options[11] = new Option('دستنائ', 'دستنائ');
                options[12] = new Option('دشتك', 'دشتك');
                options[13] = new Option('سامان', 'سامان');
                options[14] = new Option('سودجان', 'سودجان');
                options[15] = new Option('سورشجان', 'سورشجان');
                options[16] = new Option('شلمزار ـ كیار', 'شلمزار ـ كیار');
                options[17] = new Option('شهركرد', 'شهركرد');
                options[18] = new Option('فارسان', 'فارسان');
                options[19] = new Option('فرادنبه', 'فرادنبه');
                options[20] = new Option('فرخ شهر', 'فرخ شهر');
                options[21] = new Option('كیان', 'كیان');
                options[22] = new Option('گندمان', 'گندمان');
                options[23] = new Option('گهرو', 'گهرو');
                options[24] = new Option('لردگان', 'لردگان');
                options[25] = new Option('مال خلیفه', 'مال خلیفه');
                options[26] = new Option('ناغان', 'ناغان');
                options[27] = new Option('هارونی', 'هارونی');
                options[28] = new Option('هفشجان', 'هفشجان');
                options[29] = new Option('وردنجان', 'وردنجان');
            }
            if (province === '{{ $provinces[25] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('ابركوه', 'ابركوه');
                options[2] = new Option('احمدآباد', 'احمدآباد');
                options[3] = new Option('اردكان', 'اردكان');
                options[4] = new Option('بافق', 'بافق');
                options[5] = new Option('بفروئیه', 'بفروئیه');
                options[6] = new Option('بهاباد', 'بهاباد');
                options[7] = new Option('تفت', 'تفت');
                options[8] = new Option('حمیدیا', 'حمیدیا');
                options[9] = new Option('زارچ', 'زارچ');
                options[10] = new Option('شاهدیه', 'شاهدیه');
                options[11] = new Option('صدوق', 'صدوق');
                options[12] = new Option('طبس', 'طبس');
                options[13] = new Option('عشق آباد', 'عشق آباد');
                options[14] = new Option('فراغه', 'فراغه');
                options[15] = new Option('مروست', 'مروست');
                options[16] = new Option('مهریز', 'مهریز');
                options[17] = new Option('میبد', 'میبد');
                options[18] = new Option('نیر', 'نیر');
                options[19] = new Option('هرات ـ خاتم', 'هرات ـ خاتم');
                options[20] = new Option('یزد', 'یزد');
            }
            if (province === '{{ $provinces[26] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اسپكه', 'اسپكه');
                options[2] = new Option('ایرانشهر', 'ایرانشهر');
                options[3] = new Option('بزمان', 'بزمان');
                options[4] = new Option('بمپور', 'بمپور');
                options[5] = new Option('بنت', 'بنت');
                options[6] = new Option('بنجار', 'بنجار');
                options[7] = new Option('پسكو', 'پسكو');
                options[8] = new Option('تیموراباد', 'تیموراباد');
                options[9] = new Option('جالق', 'جالق');
                options[10] = new Option('چابهار', 'چابهار');
                options[11] = new Option('خاش', 'خاش');
                options[12] = new Option('دوست محمد ـ هیرمند', 'دوست محمد ـ هیرمند');
                options[13] = new Option('راسك', 'راسك');
                options[14] = new Option('زابل', 'زابل');
                options[15] = new Option('زابلی', 'زابلی');
                options[16] = new Option('زاهدان', 'زاهدان');
                options[17] = new Option('زهك', 'زهك');
                options[18] = new Option('ساربوك', 'ساربوك');
                options[19] = new Option('سراوان', 'سراوان');
                options[20] = new Option('سرباز', 'سرباز');
                options[21] = new Option('سنگان', 'سنگان');
                options[22] = new Option('سوران ـ سیب سوران', 'سوران ـ سیب سوران');
                options[23] = new Option('سیركان', 'سیركان');
                options[24] = new Option('فنوج', 'فنوج');
                options[25] = new Option('قصرقند', 'قصرقند');
                options[26] = new Option('كنارك', 'كنارك');
                options[27] = new Option('كیتج', 'كیتج');
                options[28] = new Option('گلمورتی ـ دلگان', 'گلمورتی ـ دلگان');
                options[29] = new Option('گوهركوه', 'گوهركوه');
                options[30] = new Option('محمدآباد', 'محمدآباد');
                options[31] = new Option('میرجاوه', 'میرجاوه');
                options[32] = new Option('نصرت آباد', 'نصرت آباد');
                options[33] = new Option('نگور', 'نگور');
                options[34] = new Option('نیك شهر', 'نیك شهر');
                options[35] = new Option('هیدوچ', 'هیدوچ');
            }
            if (province === '{{ $provinces[27] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اركواز', 'اركواز');
                options[2] = new Option('ارمو', 'ارمو');
                options[3] = new Option('ایلام', 'ایلام');
                options[4] = new Option('ایوان', 'ایوان');
                options[5] = new Option('آبدانان', 'آبدانان');
                options[6] = new Option('آسمان آباد', 'آسمان آباد');
                options[7] = new Option('بدره', 'بدره');
                options[8] = new Option('توحید', 'توحید');
                options[9] = new Option('چشمه شیرین', 'چشمه شیرین');
                options[10] = new Option('چوار', 'چوار');
                options[11] = new Option('دره شهر', 'دره شهر');
                options[12] = new Option('دهلران', 'دهلران');
                options[13] = new Option('سرابله ـ شیروان و چرداول', 'سرابله ـ شیروان و چرداول');
                options[14] = new Option('شباب ', 'شباب ');
                options[15] = new Option('شهرك اسلامیه', 'شهرك اسلامیه');
                options[16] = new Option('لومار', 'لومار');
                options[17] = new Option('مهران', 'مهران');
                options[18] = new Option('موسیان', 'موسیان');
                options[19] = new Option('میمه', 'میمه');
            }
            if (province === '{{ $provinces[28] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('باشت', 'باشت');
                options[2] = new Option('پاتاوه', 'پاتاوه');
                options[3] = new Option('چرام', 'چرام');
                options[4] = new Option('دهدشت ـ كهگیلویه', 'دهدشت ـ كهگیلویه');
                options[5] = new Option('دوگنبدان ـ گچساران', 'دوگنبدان ـ گچساران');
                options[6] = new Option('دیشموك', 'دیشموك');
                options[7] = new Option('سپیدار', 'سپیدار');
                options[8] = new Option('سوق', 'سوق');
                options[9] = new Option('سی سخت ـ دنا', 'سی سخت ـ دنا');
                options[10] = new Option('قلعه رئیسی', 'قلعه رئیسی');
                options[11] = new Option('لنده', 'لنده');
                options[12] = new Option('لیكك', 'لیكك');
                options[13] = new Option('مادوان', 'مادوان');
                options[14] = new Option('یاسوج ـ 7591', 'یاسوج ـ 7591');
            }
            if (province === '{{ $provinces[29] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اسفراین', 'اسفراین');
                options[2] = new Option('ایور', 'ایور');
                options[3] = new Option('آشخانه ـ مانه و سلمقان', 'آشخانه ـ مانه و سلمقان');
                options[4] = new Option('بجنورد', 'بجنورد');
                options[5] = new Option('جاجرم', 'جاجرم');
                options[6] = new Option('درق', 'درق');
                options[7] = new Option('راز', 'راز');
                options[8] = new Option('شوقان', 'شوقان');
                options[9] = new Option('شیروان', 'شیروان');
                options[10] = new Option('فاروج', 'فاروج');
                options[11] = new Option('گرمه', 'گرمه');
            }
            if (province === '{{ $provinces[30] }}') {
                options[0] = new Option('لطفا شهر را انتخاب نمایید', '0');
                options[1] = new Option('ارسك', 'ارسك');
                options[2] = new Option('اسدیه ـ درمیان', 'اسدیه ـ درمیان');
                options[3] = new Option('آرین شهر', 'آرین شهر');
                options[4] = new Option('آیسك', 'آیسك');
                options[5] = new Option('بشرویه', 'بشرویه');
                options[6] = new Option('بیرجند', 'بیرجند');
                options[7] = new Option('حاجی آباد', 'حاجی آباد');
                options[8] = new Option('خضری دشت بیاض', 'خضری دشت بیاض');
                options[9] = new Option('خوسف', 'خوسف');
                options[10] = new Option('زهان', 'زهان');
                options[11] = new Option('سر بیشه', 'سر بیشه');
                options[12] = new Option('سرایان', 'سرایان');
                options[13] = new Option('سه قلعه', 'سه قلعه');
                options[14] = new Option('فردوس', 'فردوس');
                options[15] = new Option('قائن ـ قائنات', 'قائن ـ قائنات');
                options[16] = new Option('گزیک', 'گزیک');
                options[17] = new Option('مود', 'مود');
                options[18] = new Option('نهبندان', 'نهبندان');
                options[19] = new Option('نیمبلوك', 'نیمبلوك');
            }
            if (province === '{{ $provinces[31] }}') {
                options[0] = options[0] = new Option('لطفا شهر را انتخاب نمایید', 'default');
                options[1] = new Option('اشتهارد', 'اشتهارد');
                options[2] = new Option('آسارا', 'آسارا');
                options[3] = new Option('چهارباغ', 'چهارباغ');
                options[4] = new Option('سیف آباد', 'سیف آباد');
                options[5] = new Option('شهر جدید هشتگرد', 'شهر جدید هشتگرد');
                options[6] = new Option('طالقان', 'طالقان');
                options[7] = new Option('كرج', 'كرج');
                options[8] = new Option('كمال شهر', 'كمال شهر');
                options[9] = new Option('كوهسار ـ چندار', 'كوهسار ـ چندار');
                options[10] = new Option('گرمدره', 'گرمدره');
                options[11] = new Option('ماهدشت', 'ماهدشت');
                options[12] = new Option('محمدشهر', 'محمدشهر');
                options[13] = new Option('مشکین دشت', 'مشکین دشت');
                options[14] = new Option('نظرآباد', 'نظرآباد');
                options[15] = new Option('هشتگرد ـ ساوجبلاغ', 'هشتگرد ـ ساوجبلاغ');
            }
        }
    }
</script>
