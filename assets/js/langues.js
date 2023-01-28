var items;
var deflt = 0;
var dflt = 'English'
var previos = 0;

function initLang()
{
     items = [
        ['HOME', 'PAGE D\'ACCUEIL','الصفحة الرئيسية'],
        ['ABOUT', 'QUI SOMMES-NOUS','من نحن'],
        ['SERVICES', 'SERVICES','خدمات'],
        ['GIGS','CONCERTS','العربات'],
        ['LOGIN','CONNEXION','تسجيل الدخول'],
        ['CONTACT','CONTACT','اتصال'],
        ['Let\'s Begin','Commençons','هيا نبدأ'],
        ['Learn More','Apprendre plus','اقرأالمزيد'],
        ['Expertise. Commitment. Value.','Compétence. Engagement. Évaluer.','خبرة. التزام. قيمة.'],
        ['Data Science','Sciences des données','علم البيانات'],
        ['Data analysis and visualization ','Analyse et visualisation des données  ','تحليل البيانات وتصورها'],
        ['Predictive modeling ','Modélisation prédictive ','النمذجة التنبؤية'],
        ['Machine learning ','Apprentissage automatique ','التعلم الآلي'],
        ['Data engineering ','Ingénierie des données ','هندسة البيانات'],
        ['Data consulting ',"Conseil en données ",'استشارة البيانات'],
        ['Natural language processing ',"Traitement du langage naturel",'معالجة اللغة الطبيعية'],
        ['Designing and building websites from scratch',"Concevoir et créer des sites Web à partir de zéro",'تصميم وبناء المواقع من الصفر'],
        ['Customizing and improving existing websites',"Personnalisation et amélioration des sites Web existants",'تخصيص وتحسين المواقع الموجودة'],
        ['Maintenance and support for websites',"Maintenance et support des sites internet",'صيانة ودعم المواقع'],
        ['E-commerce development',"Développement du commerce électronique",'تطوير التجارة الإلكترونية'],
        ['Mobile app development',"Développement d'applications mobiles",'تطوير تطبيقات الجوال'],
        ['Content creation',"Création de contenu",'انشاء محتوى'],
        ['Domain registration',"Enregistrement de domaines",'تسجيل النطاقات'],
        ['Web Dev',"Dév Web",'تطوير الويب'],
        ['Keyword research',"- Recherche de mots-clés",'البحث عن الكلمات الرئيسية'],
        ['SEO',"SEO",'محرك البحث الأمثل'],
        ['On-page optimization',"Optimisation sur la page",'التحسين على الصفحة'],
        ['Technical SEO',"Technical SEO",'تحسين محركات البحث الفني'],
        ['Social media management',"Gestion des médias sociaux",'إدارة وسائل التواصل الاجتماعي'],
        ['Content marketing',"Marketing de contenu",'تسويق المحتوى'],
        ['Reporting and analytics',"Rapports et analyses",'إعداد التقارير والتحليلات'],
        ['About Us',"À propos de nous",'معلومات عنا'],
        ['Hello, We Are ',"Bonjour nous sommes ",'مرحبا نحن '],
        ['Graphic Design, Web Dev , Data Science and much more.',"Conception graphique, développement Web, science des données et bien plus encore.",'تصميم الجرافيك وتطوير الويب وعلوم البيانات وغير ذلك الكثير.'],
        ['Our digital startup specializes in business development offers a range of services including website creation and data science. Our team of experts is dedicated to helping businesses succeed by designing and building custom websites and utilizing data analysis and predictive modeling to drive informed decision making. From start to finish, we work closely with our clients to understand their needs and goals, and deliver results that exceed expectations. Let us help take your business to the next level.',"Notre startup numérique est spécialisée dans le développement des affaires et propose une gamme de services comprenant la création de sites Web et la science des données. Notre équipe d'experts se consacre à aider les entreprises à réussir en concevant et en créant des sites Web personnalisés et en utilisant l'analyse de données et la modélisation prédictive pour favoriser une prise de décision éclairée. Du début à la fin, nous travaillons en étroite collaboration avec nos clients pour comprendre leurs besoins et leurs objectifs, et fournir des résultats qui dépassent les attentes. Laissez-nous vous aider à faire passer votre entreprise au niveau supérieur.",'تتخصص شركتنا الرقمية الناشئة في تطوير الأعمال وتقدم مجموعة من الخدمات بما في ذلك إنشاء مواقع الويب وعلوم البيانات. فريق الخبراء لدينا مكرس لمساعدة الشركات على النجاح من خلال تصميم وبناء مواقع ويب مخصصة واستخدام تحليل البيانات والنمذجة التنبؤية لدفع عملية صنع القرار المستنير. من البداية إلى النهاية ، نعمل عن كثب مع عملائنا لفهم احتياجاتهم وأهدافهم ، وتحقيق نتائج تفوق التوقعات. دعنا نساعدك في نقل عملك إلى المستوى التالي.'],
        ['Our Skills',"Nos compétences",'مهاراتنا'],
        ['Years Experience',"années d'expérience",'سنوات خبرة'],
        ['Happy Clients',"Clients heureux",'الزبائن سعداء'],
        ['Awards Win',"Gagner des récompenses",'الفوز بالجوائز'],
        ['Cups of Coffee',"Tasses de café",'كؤوس من القهوة'],
        ['Here are our main SERVICES.',"Voici nos principaux SERVICES.",'هنا خدماتنا الرئيسية.'],
        ['Website Development',"Développement de site Web",'تطوير المواقع'],
        ['Mobile App Development',"Développement d'applications mobiles",'تطوير تطبيقات الجوال'],
        ['Product Testing & Support',"Test de produit et assistance",'اختبار المنتج والدعم'],
        ['Data Science ( Machine learning , Deep Learning and NLP)',"Science des données (apprentissage automatique, apprentissage profond et NLP)",'علم البيانات (التعلم الآلي ، التعلم العميق و البرمجة اللغوية العصبية)'],
        ['Business Intelligence and Analytics',"Intelligence d'affaires et analytique",'ذكاء الأعمال والتحليلات'],
        ['UI/UX Creator & Consultancy',"Créateur UI / UX & Conseil",'إنشاء UI / UX والاستشارات'],
        ['Why choose Us',"Pourquoi nous choisir",'لماذا أخترتنا'],
        ['There are several reasons why clients should choose our freelancing startup for their project needs.',"Il y a plusieurs raisons pour lesquelles les clients devraient choisir notre startup indépendante pour leurs besoins de projet.",'هناك العديد من الأسباب التي تجعل العملاء يختارون شركة ناشئة مستقلة لتلبية احتياجات مشاريعهم.'],
        ['Easy to use',"Facile à utiliser",'سهل الاستخدام'],
        ['Our platform is easy to use and provides a secure way to manage payments and communication with freelancers, making the process as seamless as possible.',"Notre plate-forme est facile à utiliser et offre un moyen sécurisé de gérer les paiements et la communication avec les indépendants, rendant le processus aussi transparent que possible.",'منصتنا سهلة الاستخدام وتوفر طريقة آمنة لإدارة المدفوعات والتواصل مع المستقلين ، مما يجعل العملية سلسة قدر الإمكان.'],
        ['Quality Work',"Qualité de travail",'نوعية العمل'],
        ['We have a diverse pool of highly skilled and experienced freelancers who are dedicated to delivering high-quality work to meet clients expectations.',"Nous avons un bassin diversifié de pigistes hautement qualifiés et expérimentés qui se consacrent à fournir un travail de haute qualité pour répondre aux attentes des clients.",'لدينا مجموعة متنوعة من العاملين المستقلين ذوي المهارات العالية والخبرة والذين يكرسون جهودهم لتقديم عمل عالي الجودة لتلبية توقعات العملاء.'],
        ['Afforddable Prices for our Clients',"Des prix abordables pour nos clients",'أسعار مناسبة لعملائنا'],
        ['Our prices are competitive and we offer flexible payment options, we can work on different budget range.Choose us and you will have peace of mind that your project is in good hands.',"Nos prix sont compétitifs et nous offrons des options de paiement flexibles, nous pouvons travailler sur différentes gammes de budget. Choisissez-nous et vous aurez l'esprit tranquille que votre projet est entre de bonnes mains.",'أسعارنا تنافسية ونقدم خيارات دفع مرنة ، يمكننا العمل على نطاق مختلف للميزانية ، اخترنا وستطمئن إلى أن مشروعك في أيد أمينة.'],
        ['Completed on right time',"Terminé au bon moment",'أنجزت في الوقت المناسب'],
        ['We pride ourselves on our responsive customer service and are always available to answer any questions and address any concerns in any time 24/7.',"Nous sommes fiers de notre service client réactif et sommes toujours disponibles pour répondre à toutes les questions et répondre à toutes les préoccupations à tout moment, 24h/24 et 7j/7.",'نحن نفخر بأنفسنا لخدمة العملاء المتجاوبة لدينا ومتاحون دائمًا للإجابة على أي أسئلة ومعالجة أي مخاوف في أي وقت على مدار الساعة طوال أيام الأسبوع.'],
        ['Here are some of our GIGS.',"Voici quelques-uns de nos concerts.",'فيما يلي بعض من العربات لدينا.'],
        ['ALL',"Tous",'الكل'],
        ['Other',"Autre",'آخر'],
        ['Data Analysis',"L'analyse des données",'تحليل البيانات'],
        ['Graphic Design',"Conception graphique",'تصميم غرافيك'],
        ['Web Development',"Développement web",'تطوير الويب'],
        [' Why should someone choose our freelancing company?',"Pourquoi quelqu'un devrait-il choisir notre entreprise indépendante?",'لماذا يجب أن يختار شخص ما شركتنا المستقلة؟'],
        ['Frequently asked questions',"Questions fréquemment posées",'أسئلة مكررة'],
        ['Our freelancing company offers a wide range of services and has a team of highly skilled and experienced freelancers who are experts in their respective fields. We also have a strict vetting process to ensure that only the best freelancers are selected to work with us. Additionally, our company is dedicated to providing excellent customer service and ensuring that all of our clients are satisfied with the work we provide.What sets our freelancing company apart from others? Our freelancing company sets itself apart from others by offering a wide range of services and having a team of highly skilled and experienced freelancers. Additionally, we have a strict vetting process in place to ensure that only the best freelancers are selected to work with us. Our company is also dedicated to providing excellent customer service and ensuring that all of our clients are satisfied with the work we provide',
        "Notre société de freelance propose une large gamme de services et dispose d'une équipe de freelances hautement qualifiés et expérimentés, experts dans leurs domaines respectifs. Nous avons également un processus de vérification strict pour nous assurer que seuls les meilleurs freelances sont sélectionnés pour travailler avec nous. De plus, notre entreprise s'engage à fournir un excellent service client et à s'assurer que tous nos clients sont satisfaits du travail que nous fournissons. Qu'est-ce qui distingue notre entreprise indépendante des autres ? Notre société de freelance se démarque des autres en offrant une large gamme de services et en disposant d'une équipe de freelances hautement qualifiés et expérimentés. De plus, nous avons mis en place un processus de vérification strict pour nous assurer que seuls les meilleurs freelances sont sélectionnés pour travailler avec nous. Notre entreprise s'engage également à fournir un excellent service client et à s'assurer que tous nos clients sont satisfaits du travail que nous fournissons.",
        'تقدم شركتنا لحسابهم الخاص مجموعة واسعة من الخدمات ولديها فريق من العاملين المستقلين ذوي المهارات العالية والخبرة والذين هم خبراء في مجالات تخصصهم. لدينا أيضًا عملية فحص صارمة لضمان اختيار أفضل العاملين المستقلين فقط للعمل معنا. بالإضافة إلى ذلك ، فإن شركتنا مكرسة لتقديم خدمة عملاء ممتازة وضمان رضا جميع عملائنا عن العمل الذي نقدمه. ما الذي يميز شركتنا المستقلة عن الآخرين؟ تميز شركتنا المستقلة عن الآخرين من خلال تقديم مجموعة واسعة من الخدمات ولديها فريق من العاملين المستقلين ذوي المهارات العالية والخبرة. بالإضافة إلى ذلك ، لدينا عملية فحص صارمة لضمان اختيار أفضل العاملين لحسابهم الخاص فقط للعمل معنا. شركتنا مكرسة أيضًا لتقديم خدمة عملاء ممتازة وضمان رضا جميع عملائنا عن العمل الذي نقدمه'],
        ['How does our freelancing company ensure quality work for clients?',"Comment notre entreprise indépendante assure-t-elle un travail de qualité pour les clients ?",'كيف تضمن شركتنا المستقلة العمل الجودة للعملاء؟'],
        ['Our freelancing company ensures quality work for clients by only hiring highly skilled and experienced freelancers. Additionally, we have a strict vetting process in place to ensure that only the best freelancers are selected to work with us. We also have a dedicated quality assurance team that reviews all work before it is submitted to the client to ensure that it meets the clients specifications and is of the highest quality.',
        "Notre entreprise indépendante garantit un travail de qualité pour les clients en embauchant uniquement des pigistes hautement qualifiés et expérimentés. De plus, nous avons un processus de vérification strict en place pour nous assurer que seuls les meilleurs pigistes sont sélectionnés pour travailler avec nous. Nous avons également une équipe d'assurance qualité dédiée qui examine tous les travaux avant d'être soumis au client pour s'assurer qu'il répond aux spécifications du client et est de la plus haute qualité.",
        'تضمن شركتنا المستقلة العمل الجيد للعملاء من خلال توظيف المستقلين ذوي المهارات العالية وذوي الخبرة. بالإضافة إلى ذلك ، لدينا عملية فحص صارمة لضمان اختيار أفضل المستقلين فقط للعمل معنا. لدينا أيضًا فريق ضمان جودة مخصص يقوم بمراجعة جميع العمل قبل تقديمه إلى العميل للتأكد من أنه يفي بمواصفات العميل وهو أعلى جودة.'],
        ['How do we handle client communication and project management?',"Comment gérons-nous la communication client et la gestion de projet ?",'كيف نتعامل مع اتصالات العميل وإدارة المشاريع؟'],
        ['Our freelancing company has a dedicated project management team that handles all client communication and project management. They work closely with clients to ensure that all of their needs are met and that projects are completed on time and to the clients satisfaction. They are also available 24/7 to address any questions or concerns that clients may have throughout the project.',
        "Notre société indépendante dispose d'une équipe de gestion de projet dédiée qui gère toutes les communications avec les clients et la gestion de projet. Ils travaillent en étroite collaboration avec les clients pour s'assurer que tous leurs besoins sont satisfaits et que les projets sont terminés à temps et à la satisfaction du client. Ils sont également disponibles 24h/24 et 7j/7 pour répondre à toutes les questions ou préoccupations que les clients pourraient avoir tout au long du projet.",
        'لدى شركتنا المستقلة فريق إدارة مشروع متخصص يتعامل مع جميع اتصالات العملاء وإدارة المشاريع. إنهم يعملون عن كثب مع العملاء لضمان تلبية جميع احتياجاتهم وإنجاز المشاريع في الوقت المحدد وبما يرضي العميل. كما أنها متاحة على مدار الساعة طوال أيام الأسبوع للرد على أي أسئلة أو مخاوف قد تكون لدى العملاء طوال فترة المشروع.'],
        ['Team',"Équipe",'الفريق'],
        ['Meet our Team.',"Rencontrez notre équipe.",'التق بفريقنا'],
        ['Data Analyst',"Analyste de données",'محلل بيانات'],
        ['Project Manager',"Chef de projets",'مدير المشاريع'],
        ['Marketing Specialist',"Spécialiste en marketing",'اخصائي تسويق'],
        ['We highly recommend that our clients take advantage of our freelancing services to help them achieve their business goals.',
        "Nous recommandons fortement à nos clients de profiter de nos services de freelance pour les aider à atteindre leurs objectifs commerciaux.",
        'نوصي بشدة أن يستفيد عملاؤنا من خدمات العمل المستقل التي نقدمها لمساعدتهم على تحقيق أهداف أعمالهم.'],
        ['By purchasing our services, clients can access a pool of highly skilled professionals who are able to work on a variety of projects, from small tasks to large-scale endeavors. With our platform, clients can find the right freelancer for their specific needs, ensuring that the work is completed to the highest standards. Additionally, our platform offers an easy and secure way to manage payments and communication with freelancers, making the process as seamless as possible. Contact us today to learn more about how our freelancing services can help your business grow.',
        "En achetant nos services, les clients peuvent accéder à un bassin de professionnels hautement qualifiés capables de travailler sur une variété de projets, des petites tâches aux projets à grande échelle. Grâce à notre plateforme, les clients peuvent trouver le bon pigiste pour leurs besoins spécifiques, en s'assurant que le travail est effectué selon les normes les plus élevées. De plus, notre plateforme offre un moyen simple et sécurisé de gérer les paiements et la communication avec les indépendants, rendant le processus aussi transparent que possible. Contactez-nous dès aujourd'hui pour en savoir plus sur la façon dont nos services de freelance peuvent aider votre entreprise à se développer.",
        'من خلال شراء خدماتنا ، يمكن للعملاء الوصول إلى مجموعة من المهنيين ذوي المهارات العالية القادرين على العمل في مجموعة متنوعة من المشاريع ، من المهام الصغيرة إلى المساعي واسعة النطاق. من خلال منصتنا ، يمكن للعملاء العثور على المستقل المناسب لاحتياجاتهم الخاصة ، مما يضمن إكمال العمل وفقًا لأعلى المعايير. بالإضافة إلى ذلك ، توفر منصتنا طريقة سهلة وآمنة لإدارة المدفوعات والتواصل مع المستقلين ، مما يجعل العملية سلسة قدر الإمكان. اتصل بنا اليوم لمعرفة المزيد حول كيف يمكن لخدمات العمل المستقل التي نقدمها أن تساعد في نمو أعمالك.'],
        ['Contact Us',"Nous contacter",'اتصل بنا'],
        ['Our Prices.',"Nos prix.",'أسعارنا'],
        ['Pricing Area',"Zone de tarification",'منطقة التسعير'],
        ['Our freelancing startup aims to connect businesses and individuals with skilled professionals for a variety of project needs. By contacting us, clients can access a diverse pool of talent and find the right freelancer for their specific project requirements. From design and development to writing and research, our platform offers a wide range of services to meet the unique needs of each client.',
        "Notre startup indépendante vise à mettre en relation les entreprises et les particuliers avec des professionnels qualifiés pour une variété de besoins de projets. En nous contactant, les clients peuvent accéder à un bassin diversifié de talents et trouver le bon pigiste pour les besoins spécifiques de leur projet. De la conception et du développement à la rédaction et à la recherche, notre plateforme offre une large gamme de services pour répondre aux besoins uniques de chaque client.",
        'تهدف شركتنا التي تعمل لحسابها الخاص إلى ربط الشركات والأفراد بالمهنيين المهرة لتلبية مجموعة متنوعة من احتياجات المشروع. من خلال الاتصال بنا ، يمكن للعملاء الوصول إلى مجموعة متنوعة من المواهب والعثور على المستقل المناسب لمتطلبات مشروعهم المحددة. من التصميم والتطوير إلى الكتابة والبحث ، تقدم منصتنا مجموعة واسعة من الخدمات لتلبية الاحتياجات الفريدة لكل عميل.'],
        ['Contact us today to learn more about how our freelancing startup can help you achieve your goals.',"Contactez-nous dès aujourd'hui pour en savoir plus sur la façon dont notre startup indépendante peut vous aider à atteindre vos objectifs.",'اتصل بنا اليوم لمعرفة المزيد حول كيف يمكن لشركتنا الناشئة المستقلة أن تساعدك على تحقيق أهدافك.'],
        ['Send Message',"Envoyé message",'أرسل رسالة'],
        ['',"",''],
        ['',"",''],
        ['',"",''],
        ['',"",''],
        ['',"",''],
        ['',"",''],
        
      ];
}

function changeLangs()
{
   
    
    console.log(this.textContent)
    if(this.textContent == dflt)
    {

    }
    else
    {
        var element = $('.typed');
        element.data('typed').reset();
        var tpd = ['',''];
        var ttle='';
        if(this.textContent == 'Arabic')
        {
            ttle='خدمات تكنولوجيا المعلومات الرقمية';
            tpd = ["مصمم الويب.", "مصمم جرافيك."]
            deflt = 2;
            dflt = 'Arabic'
        }
        else if(this.textContent == 'English')
        {
            ttle='DIGITAL IT Services';
            tpd = ["Web Designer.", "Graphic Designer."]
            deflt = 0;
            dflt = 'English'
        }
        else if(this.textContent == 'French')
        {
            ttle='Services informatiques numériques';
            tpd = ["Web Designer.", "Designer graphique."]
            deflt = 1;
            dflt = 'French'
        }
        var B = document.getElementsByClassName('hrvatski');
        for (let i = 0; i < B.length; i++) {
            for (let j = 0; j < items.length; j++) {
                //console.log(B[i].textContent)
                if(B[i].textContent.toLowerCase() == items[j][previos].toLowerCase())
                {
                    console.log(B[i].textContent)
                    
                    B[i].innerHTML = items[j][deflt]
                }
            }
        }
        previos = deflt;
        if(this.textContent == 'Arabic')
        {
            var C = document.getElementsByClassName('liman');
            for (let x = 0; x < C.length; x++) {
                C[x].style.direction = "rtl";
                C[x].style.textAlign = "right";
        }
        }
        else{
            var C = document.getElementsByClassName('liman');
            for (let x = 0; x < C.length; x++) {
                C[x].style.direction = "ltr";
                C[x].style.textAlign = "left";
            }
        }
        $(function () {
            element.typed({
                strings: tpd,
                typeSpeed: 100,
                loop: true,
                autoplay: true,
            });
        });
        document.title = ttle;
    }
    // if(this.textContent == 'Arabic')
    // {
    //     var B = document.getElementsByClassName('hrvatski');
    //     for (let i = 0; i < B.length; i++) {
    //         for (let j = 0; j < items.length; j++) {
    //             //console.log(B[i].textContent)
    //             if(B[i].textContent == items[j][0])
    //             {
    //                 console.log(B[i].textContent)
    //                 B[i].textContent = items[j][2]
    //             }
    //         }
    //     }
    //     var C = document.getElementsByClassName('liman');
    //     for (let x = 0; x < C.length; x++) {
    //         C[x].style.direction = "rtl";
    //         C[x].style.textAlign = "right";
    //     }
    // }
}

function changeMode()
{
    console.log(this.parentElement.children[0].checked)
    if(!this.parentElement.children[0].checked)
    {
        document.body.style.backgroundColor = "black";
        document.body.style.color = "white";
        var C = document.getElementsByTagName('section');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByClassName('bg-white');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByClassName('single-featured-item');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByClassName('single-service');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByClassName('single-blog');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByTagName('section');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "black", "important");
            C[x].style.color = "white";
        }
        var C = document.getElementsByTagName('h2');
        for (let x = 0; x < C.length; x++) {
            if(C[x].id!="exclus")
                C[x].style.setProperty("color", "white", "important");
        }
        var C = document.getElementsByTagName('h4');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("color", "white", "important");
        }
        var C = document.getElementsByTagName('p');
        for (let x = 0; x < C.length; x++) {
            if(C[x].id!="exclus")
                C[x].style.setProperty("color", "white", "important");
        }
    }
    else
    {
        document.body.style.backgroundColor = "white";
        document.body.style.color = "black";
        var C = document.getElementsByTagName('section');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByClassName('bg-white');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByClassName('single-featured-item');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByClassName('single-service');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByClassName('single-blog');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByTagName('section');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("background-color", "white", "important");
            C[x].style.color = "black";
        }
        var C = document.getElementsByTagName('h2');
        for (let x = 0; x < C.length; x++) {
            if(C[x].id!="exclus")
                C[x].style.setProperty("color", "black", "important");
        }
        var C = document.getElementsByTagName('h4');
        for (let x = 0; x < C.length; x++) {
            C[x].style.setProperty("color", "black", "important");
        }
        var C = document.getElementsByTagName('p');
        for (let x = 0; x < C.length; x++) {
            if(C[x].id!="exclus")
                C[x].style.setProperty("color", "black", "important");
        }
    }
}

window.onload = function()
{

    function getVideoCardInfo() {
        const gl = document.createElement('canvas').getContext('webgl');
        if (!gl) {
          return {
            error: "no webgl",
          };
        }
        const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
        return debugInfo ? {
          vendor: gl.getParameter(debugInfo.UNMASKED_VENDOR_WEBGL),
          renderer:  gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL),
        } : {
          error: "no WEBGL_debug_renderer_info",
        };
      }
      
      console.log(getVideoCardInfo());

    initLang();
    console.log(items)

    var A = document.getElementsByClassName('lngs');
    for (let i = 0; i < A.length; i++) {
        A[i].addEventListener('click',changeLangs);
    }

    var B = document.getElementsByClassName('slider');
    for (let i = 0; i < B.length; i++) {
        B[i].addEventListener('click',changeMode);
    }

}