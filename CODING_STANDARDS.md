# قواعد بناء المشروع - إلزامية 100% (للذكاء الاصطناعي)

## المبادئ الأساسية (غير قابلة للنقاش)
- SOLID + DRY + KISS + YAGNI
- Clean Code (روبرت مارتن) مطبّق حرفياً
- كل دالة تقوم بشيء واحد فقط (Single Responsibility)
- أقصى عدد وسيطات للدالة = 3 (ممنوع أكثر)
- ممنوع أي Boolean parameter (ممنوع function($id, true))
- ممنوع Magic Numbers/Strings → استخدم Constants أو Enums
- أسماء المتغيرات والدوال بالإنجليزية فقط (camelCase أو PascalCase حسب السياق)
- كلاسات ودوال ومتغيرات لها أسماء واضحة 100% (ممنوع $x، $data، $arr...)

## الهيكل المطلوب (Laravel)
app/
├── Domains/               ← كل الموديلات واللوجيك الفعلي هنا
├── Http/
│   ├── Controllers/       ← Single Action Controllers فقط (__invoke)
│   ├── Requests/          ← Form Requests لكل عملية
│   └── Resources/         ← API Resources فقط
├── Services/              ← كل الـ Business Logic هنا
├── Repositories/          ← Eloquent Repositories + Interfaces
└── DTOs/                  ← Data Transfer Objects (pure classes)

## القواعد الإلزامية في الكود
- كل Service وRepository له Interface ويتم حقنه عبر DI
- ممنوع أي Query في Controller → كل شيء في Repository أو Service
- كل Model له Local Scope لأي استعلام متكرر
- استخدام DTO بدل Request->all() أو arrays
- كل Action (create/update/delete) في Service منفصل
- استخدام Custom Exceptions مع Exception Handler واضح
- كل Model يستخدم Attribute Casting + Accessors فقط عند الحاجة
- Route Model Binding + Form Request Validation فقط
- كل API Response يمر من Resource Class
- استخدام Enums (PHP 8.1+) لكل حالة (Status, Type...)
- declare(strict_types=1) في كل ملف PHP
- استخدام typed properties وreturn types في كل مكان ممكن
- ممنوع أي "or fail()" أو "firstOrFail()" خارج الـ Controller
- كل Transaction يتم في Service وليس Controller

## الأنماط الممنوعة تماماً
- Fat Controllers
- God Classes
- Anemic Domain Model
- use App\Models\User; داخل أي Service أو Repository
- Query Builder مباشرة في Controller
- $request->all() في أي مكان غير Form Request

## أمثلة للأوامر المقبولة من الآن فصاعداً
- "اعمل لي CreateSaleService مع DTO"
- "اعمل لي SaleRepository مع Interface"
- "اعمل لي StoreSaleRequest (Form Request) بالقواعد دي..."
- "اعمل لي SaleResource للـ API"

كل طلب خارج هذه القواعد يتم رفضه تلقائياً.

المشروع يُبنى بهذا الشكل أو لا يُبنى أصلاً.