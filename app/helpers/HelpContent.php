<?php
/**
 * Массив инструкций помощи для админ-панели на казахском языке
 */

return [
    'dashboard' => [
        'title' => 'Басты бет - Dashboard',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">📊 СӨЗ БАСТЫ БЕТ</h4>
                
                <p>Бұл беттен сайттың барлық статистикасын көре аласыз:</p>
                
                <ul class="list-disc pl-5 space-y-2">
                    <li><strong>Мақалалар саны</strong> - жариялаған жаңалықтарыңыз</li>
                    <li><strong>Пікірлер саны</strong> - оқырмандардың түсініктемелері</li>
                    <li><strong>Қолданушылар</strong> - әкімшілер саны</li>
                    <li><strong>Санаттар</strong> - жаңалықтар категориялары</li>
                </ul>
                
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                    <h5 class="font-bold mb-2">🔍 СОЛ ЖАҚТАҒЫ МӘЗІР:</h5>
                    <ul class="space-y-1 text-sm">
                        <li>👉 <strong>Мақалалар</strong> - жаңалықтарды басқару</li>
                        <li>👉 <strong>Санаттар</strong> - категорияларды басқару</li>
                        <li>👉 <strong>Пікірлер</strong> - түсініктемелерді модерациялау</li>
                        <li>👉 <strong>Қолданушылар</strong> - әкімшілерді басқару</li>
                        <li>👉 <strong>Баптаулар</strong> - сайт параметрлері</li>
                    </ul>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm">
                        💡 <strong>Кеңес:</strong> Жаңа мақала қосу үшін сол жақтағы мәзірден 
                        "Мақалалар" → "+ Жаңа мақала қосу" басыңыз
                    </p>
                </div>
            </div>
        '
    ],

    'posts-list' => [
        'title' => 'Мақалалар тізімі',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">📰 МАҚАЛАЛАРДЫ БАСҚАРУ</h4>
                
                <div class="space-y-3">
                    <div>
                        <h5 class="font-bold">✅ ЖАҢА МАҚАЛА ҚОСУ:</h5>
                        <p class="text-sm">Жоғарғы оң жақтағы жасыл "+ Жаңа мақала қосу" түймесін басыңыз</p>
                    </div>
                    
                    <div>
                        <h5 class="font-bold">✏️ ӨЗГЕРТУ ӮШІ�:</h5>
                        <p class="text-sm">Тізімде мақаланы табыңыз және "Өзгерту" түймесін басыңыз</p>
                    </div>
                    
                    <div>
                        <h5 class="font-bold">🗑️ ЖОЮ ҮШІН:</h5>
                        <p class="text-sm">Қызыл "Жою" түймесін басып, растаңыз</p>
                    </div>
                </div>
                
                <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
                    <h5 class="font-bold mb-2">📌 СТАТУСТАР:</h5>
                    <ul class="text-sm space-y-1">
                        <li>🟢 <strong>Published</strong> - сайтта көрінеді</li>
                        <li>⚪ <strong>Draft</strong> - жобада (әлі көрінбейді)</li>
                    </ul>
                </div>
                
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm">
                        💡 <strong>Кеңес:</strong> Мақалалар уақыты бойынша сұрыпталған - 
                        жаңа мақалалар жоғарыда болады.
                    </p>
                </div>
            </div>
        '
    ],

    'post-editor' => [
        'title' => 'Мақала қосу / өзгерту',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">✍️ МАҚАЛА ҚОСУ - ҚАДАМДЫҚ НҰСҚАУЛЫҚ</h4>
                
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-red-50 to-blue-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">📝 ҚАДАМ 1: ТАҚЫРЫП</h5>
                        <ul class="text-sm space-y-1">
                            <li>• Қазақша және орысша тақырып толтырыңыз</li>
                            <li>• Қысқа және түсінікті болсын (100 таңбаға дейін)</li>
                            <li>• 2 тілде де толтырған жөн</li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-50 to-green-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">📄 ҚАДАМ 2: МӘТІН ЖАЗУ</h5>
                        <p class="text-sm mb-2">Редактор Word сияқты - барлық мүмкіндіктер бар:</p>
                        <ul class="text-sm space-y-1 pl-4">
                            <li>• <strong>Қалың</strong>, <em>курсив</em>, <u>асты сызылған</u></li>
                            <li>• Тақырыпшалар (H2, H3, H4)</li>
                            <li>• Тізімдер (нөмірленген және маркерлеу)</li>
                            <li>• Кестелер, сілтемелер, дәйексөз</li>
                            <li>• 🖼️ Суреттерді мәтінге қосуға болады!</li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-yellow-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">🖼️ ҚАДАМ 3: БАСТЫ СУРЕТ</h5>
                        <ul class="text-sm space-y-1">
                            <li>• Оң жақта "Басты сурет" бөлімінде жүктеңіз</li>
                            <li>• JPG немесе PNG форматы</li>
                            <li>• Максимум: 5 МБ</li>
                            <li>• Ұсынылады: 1200x800 пиксель</li>
                            <li>• ✅ Жүктеген кезде бірден превью көрінеді!</li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-r from-yellow-50 to-purple-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">📁 ҚАДАМ 4: САНАТ ТАҢДАУ</h5>
                        <p class="text-sm">Оң жақта санаттардан бірін міндетті түрде таңдаңыз!</p>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">⏰ ҚАДАМ 5: УАҚЫТ</h5>
                        <ul class="text-sm space-y-1">
                            <li>• Бос қалдырсаңыз - қазір жариялайды</li>
                            <li>• Уақыт таңдасаңыз - сол уақытта жариялайды</li>
                            <li>• Мақалалар уақыт бойынша сұрыпталады</li>
                        </ul>
                    </div>
                    
                    <div class="bg-red-50 p-4 rounded-lg border-2 border-red-200">
                        <h5 class="font-bold mb-2 text-[#D60023]">🚀 ҚАДАМ 6: ЖАРИЯЛАУ</h5>
                        <ul class="text-sm space-y-1">
                            <li>🔴 <strong>"Жариялау"</strong> - сайтта көрінеді (дереу!)</li>
                            <li>⚪ <strong>"Сақтау"</strong> - жобаға сақталады (әзірше көрінбейді)</li>
                        </ul>
                    </div>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm">
                        ✅ <strong>Дайын!</strong> Мақала жарияланганнан кейін 
                        сайттың басты бетінде көрінеді.
                    </p>
                </div>
            </div>
        '
    ],

    'categories' => [
        'title' => 'Санаттар',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">📁 САНАТТАРДЫ БАСҚАРУ</h4>
                
                <p>Санаттар - мақалаларды топтастыру үшін қажет.</p>
                
                <div class="space-y-3">
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <h5 class="font-bold">➕ ЖАҢА САНАТ ҚОСУ:</h5>
                        <ol class="text-sm space-y-1 pl-5 mt-2">
                            <li>1. "+ Жаңа санат қосу" түймесін басыңыз</li>
                            <li>2. Атауын 2 тілде толтырыңыз (KZ және RU)</li>
                            <li>3. Сипаттаманы жазыңыз (қысқаша)</li>
                            <li>4. "Сақтау" басыңыз</li>
                        </ol>
                    </div>
                    
                    <div class="bg-yellow-50 p-3 rounded-lg border-l-4 border-yellow-500">
                        <h5 class="font-bold">⚠️ НАЗАР АУДАРЫҢЫЗ:</h5>
                        <p class="text-sm mt-1">
                            Санатты жою үшін оның ішінде мақалалар болмауы керек!
                            Алдымен барлық мақалаларды басқа санатқа көшіріңіз.
                        </p>
                    </div>
                </div>
                
                <div class="bg-green-50 p-3 rounded-lg">
                    <p class="text-sm">
                        💡 <strong>Кеңес:</strong> Негізгі санаттар: Жаңалықтар, Саясат, 
                        Қоғам, Экономика, Білім, Спорт
                    </p>
                </div>
            </div>
        '
    ],

    'comments' => [
        'title' => 'Пікірлерді модерациялау',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">💬 ПІКІРЛЕРДІ МОДЕРАЦИЯЛАУ</h4>
                
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h5 class="font-bold mb-2">📌 СТАТУСТАР:</h5>
                    <ul class="text-sm space-y-1">
                        <li>⏳ <strong>Күтуде</strong> - жаңа пікір, әлі бекітілмеген</li>
                        <li>✅ <strong>Бекітілген</strong> - сайтта көрінеді</li>
                    </ul>
                </div>
                
                <div class="space-y-3 mt-4">
                    <div class="bg-green-50 p-3 rounded-lg">
                        <h5 class="font-bold">✅ БЕКІТУ ӮШІ�:</h5>
                        <ol class="text-sm space-y-1 pl-5 mt-2">
                            <li>1. Пікірді оқыңыз</li>
                            <li>2. Егер дұрыс болса - жасыл ✓ түймесін басыңыз</li>
                            <li>3. Пікір дереу сайтта көрінеді</li>
                        </ol>
                    </div>
                    
                    <div class="bg-red-50 p-3 rounded-lg">
                        <h5 class="font-bold">🗑️ ЖОЮ ҮШІН:</h5>
                        <ol class="text-sm space-y-1 pl-5 mt-2">
                            <li>1. Спам немесе дөрекі пікірді табыңыз</li>
                            <li>2. Қызыл 🗑️ түймесін басыңыз</li>
                            <li>3. Жоюды растаңыз</li>
                        </ol>
                    </div>
                </div>
                
                <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
                    <h5 class="font-bold mb-2">⚠️ НЕ ЖОЮҒЫ КЕРЕК:</h5>
                    <ul class="text-sm space-y-1">
                        <li>❌ Спам мен жарнама</li>
                        <li>❌ Дөрекі сөздер</li>
                        <li>❌ Өтірік ақпарат</li>
                        <li>❌ Тақырыпқа қатысы жоқ пікірлер</li>
                    </ul>
                </div>
                
                <div class="bg-green-50 p-3 rounded-lg">
                    <p class="text-sm">
                        💡 <strong>Кеңес:</strong> Пікірлерді күн сайын тексеріп тұрыңыз. 
                        Оқырмандарға жауап жазған жөн!
                    </p>
                </div>
            </div>
        '
    ],

    'users' => [
        'title' => 'Қолданушылар (әкімшілер)',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">👥 ӘКІМШІЛЕРДІ БАСҚАРУ</h4>
                
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h5 class="font-bold mb-2">➕ ЖАҢА ӘКІМШІ ҚОСУ:</h5>
                    <ol class="text-sm space-y-1 pl-5">
                        <li>1. "+ Жаңа қолданушы" түймесін басыңыз</li>
                        <li>2. Деректерді толтырыңыз:
                            <ul class="pl-4 mt-1">
                                <li>• Логин (латын әріптерімен)</li>
                                <li>• Email</li>
                                <li>• Толық аты-жөні</li>
                                <li>• Күшті құпия сөз</li>
                                <li>• Рөл таңдаңыз</li>
                            </ul>
                        </li>
                        <li>3. "Сақтау" басыңыз</li>
                    </ol>
                </div>
                
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h5 class="font-bold mb-2">🎭 РӨЛДЕР:</h5>
                    <ul class="text-sm space-y-2">
                        <li>
                            <strong>Admin</strong> - барлық құқықтар (мақалалар, санаттар, 
                            әкімшілер, баптаулар)
                        </li>
                        <li>
                            <strong>Editor</strong> - тек мақалалар мен пікірлерді басқара алады
                        </li>
                    </ul>
                </div>
                
                <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
                    <h5 class="font-bold mb-2">🔐 ҚҰПИЯ СӨЗДІ ӨЗГЕРТУ:</h5>
                    <ol class="text-sm space-y-1 pl-5">
                        <li>1. Қолданушыны өзгертуге ашыңыз</li>
                        <li>2. "Жаңа құпия сөз" өрісіне жазыңыз</li>
                        <li>3. Сақтаңыз</li>
                    </ol>
                </div>
                
                <div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-500">
                    <h5 class="font-bold mb-2">⚠️ ҚАУІПСІЗДІК:</h5>
                    <ul class="text-sm space-y-1">
                        <li>• Құпия сөз кемінде 8 таңбадан болсын</li>
                        <li>• Әріптер + сандар + белгілер қолданыңыз</li>
                        <li>• Ешкімге құпия сөзді бермеңіз</li>
                        <li>• 3 айда бір рет өзгертіңіз</li>
                    </ul>
                </div>
            </div>
        '
    ],

    'settings' => [
        'title' => 'Баптаулар',
        'content' => '
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-[#D60023]">⚙️ САЙТ БАПТАУЛАРЫ</h4>
                
                <div class="space-y-3">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">📧 БАЙЛАНЫС АҚПАРАТЫ:</h5>
                        <ul class="text-sm space-y-1">
                            <li>• Email - редакция поштасы</li>
                            <li>• Телефон - байланыс үшін</li>
                            <li>• Мекенжай - редакцияның орналасқан жері</li>
                        </ul>
                    </div>
                    
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h5 class="font-bold mb-2">🌐 ӘЛЕУМЕТТІК ЖЕЛІЛЕР:</h5>
                        <p class="text-sm mb-2">Толық сілтемелерді жазыңыз:</p>
                        <ul class="text-sm space-y-1 pl-4">
                            <li>• Facebook: https://facebook.com/qyzylordatimes</li>
                            <li>• Instagram: https://instagram.com/qyzylordatimes</li>
                            <li>• Twitter, YouTube, Telegram...</li>
                        </ul>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-500">
                        <h5 class="font-bold mb-2">🔑 API КІЛТТЕРІ:</h5>
                        
                        <div class="space-y-3 mt-3">
                            <div>
                                <p class="font-semibold text-sm">OpenWeather API (ауа-райы):</p>
                                <ol class="text-sm mt-1 pl-5">
                                    <li>1. https://openweathermap.org ашыңыз</li>
                                    <li>2. Тіркеліңіз (тегін)</li>
                                    <li>3. API кілтін алыңыз</li>
                                    <li>4. Осында көшіріп қойыңыз</li>
                                </ol>
                            </div>
                            
                            <div>
                                <p class="font-semibold text-sm">Google reCAPTCHA (робот емес екенін тексеру):</p>
                                <ol class="text-sm mt-1 pl-5">
                                    <li>1. https://www.google.com/recaptcha/admin ашыңыз</li>
                                    <li>2. Site жасаңыз (v2 Checkbox)</li>
                                    <li>3. Site Key және Secret Key алыңыз</li>
                                    <li>4. Екеуін де осында көшіріңіз</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <p class="text-sm">
                        ⚠️ <strong>Маңызды:</strong> Өзгерістерден кейін "Сақтау" түймесін 
                        басуды ұмытпаңыз!
                    </p>
                </div>
            </div>
        '
    ]
];
