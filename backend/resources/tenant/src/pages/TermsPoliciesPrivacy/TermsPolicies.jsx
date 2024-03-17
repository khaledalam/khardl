import React from "react";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import "./style.css";
import { useSelector } from "react-redux";
import {
    MdOutlineKeyboardArrowLeft,
    MdOutlineKeyboardArrowRight,
} from "react-icons/md";
import { Link, useNavigate } from "react-router-dom";

const Privacy = ({ onClose }) => {
    const Language = useSelector((state) => state.languageMode.languageMode);
    const navigate = useNavigate();

    return (
        <>
            <div
                className="flex justify-center items-center px-[40px] max-[400px]:px-[20px]"
                style={{
                    backgroundImage: `url(${ContactUsCover})`,
                    backgroundSize: "cover",
                }}
            >
                <div className="relative flex flex-col justify-center items-center my-[80px] xl:max-w-[60%] max-[1200px]:w-[90%]  space-y-14 shadow-lg bg-white p-8 max-[860px]:p-4 rounded-lg">
                    {Language === "en" ? (
                        <div className="container ">
                            <header className="grid grid-cols-3 max-md:block mb-4 items-center font-bold text-[22px] text-[var(--primary)]">
                                <div className="blog-goBack">
                                    <button
                                        onClick={onClose}
                                        className="flex items-center gap-1 max-md:gap-0 "
                                    >
                                        {Language === "en" ? (
                                            <span>
                                                <MdOutlineKeyboardArrowLeft
                                                    size={26}
                                                />
                                            </span>
                                        ) : (
                                            <span>
                                                <MdOutlineKeyboardArrowRight
                                                    size={26}
                                                />
                                            </span>
                                        )}
                                        <span
                                            className="max-md:!font-normal max-md:text-[18px]"
                                        >
                                            {Language === "en"
                                                ? "Back"
                                                : "الرجوع"}
                                        </span>
                                    </button>
                                </div>
                                <h1 className="blog-title text-center max-sm:text-xl ">
                                    Terms & Conditions for Khardl
                                </h1>
                            </header>
                            <p>
                                These Terms and Conditions constitute a formal
                                agreement "contract" between Khardl, Inc.
                                Registered in the Kingdom of Saudi Arabia as
                                Dannf Company Ltd. with Commercial Registration
                                No.: 1010794210, and these User Terms govern
                                your use of the KHARDL services, which is an
                                electronic platform that acts as an electronic
                                portal that allows customers to receive and
                                manage orders ("Services") as the use of any
                                person was KHARDL, whether a merchant, consumer
                                or otherwise, this is considered approval and
                                acceptance from him and he is fully qualified
                                considered Shariah, system and law for all
                                articles, terms and provisions of this agreement
                                and is a confirmation of your commitment to its
                                regulations and what It is stated, and we point
                                out to you that KHARDL may be (a website, mobile
                                application or electronic platform) and this
                                agreement is valid and effective once you agree
                                to it and start subscribing to KHARDL.
                            </p>
                            <p></p>
                            <p>Boot</p>
                            <p></p>
                            <p>
                                • "KHARDL" means the Dannf Company Ltd., and
                                this definition includes all forms of the Danish
                                Company Ltd. on the Internet, whether it is an
                                electronic application, or a website on the
                                Internet.
                            </p>
                            <p></p>
                            <p>
                                • "Customer" means any merchant engaged in
                                KHARDL and KHARDL services.
                            </p>
                            <p></p>
                            <p>
                                • "Consumer" means any consumer who purchases a
                                product or service from the customer through the
                                merchant's online store established by him
                                through KHARDL.
                            </p>
                            <p>
                                • "Agreement" means the rules, terms and
                                conditions for using the KHARDL platform, i.e.
                                all the terms and conditions of this agreement,
                                which govern and regulate the relationship
                                between the parties to this agreement.
                            </p>
                            <p></p>
                            <p>
                                • "Service Provider" means the services that
                                KHARDL provides to customers through third
                                parties, and the provision of services means
                                merely providing the link between the customer
                                and the service provider.
                            </p>
                            <p>Eligibility for services</p>
                            <p></p>
                            <p>
                                • You represent and warrant that: Your use of
                                the KHARDL Services has never been disabled or
                                prevented from using them at any time.
                            </p>
                            <p></p>
                            <p>
                                • You have full power and authority to contract
                                and you will not be in breach of any law or
                                agreement.
                            </p>
                            <p></p>
                            <p>Scope of the license</p>
                            <p></p>
                            <p>
                                You grant the customer a non-exclusive,
                                non-transferable, non-assignable, non-sub
                                licensable and irrevocable license to acquire
                                and use our Services.
                            </p>
                            <p> </p>
                            <p>
                                • Not to make the Services available or to rent,
                                rent, assign, resell, distribute or sublicense
                                the Services to any third party.
                            </p>
                            <p>
                                • Not modify, trim, translate, summarize, create
                                a sub-work based on decompiling, reverse
                                engineering the design of the KHARDL application
                                or otherwise identify or attempt to identify or
                                attempt to access the source code, the internal
                                design of the Services or any text, multimedia
                                images (images, audio, video files), data or
                                other information provided by KHARDL or third
                                party service providers.
                            </p>
                            <p></p>
                            <p>
                                • Not to delete, change, or otherwise modify any
                                copyright or other official notices contained in
                                the Services.
                            </p>
                            <p>
                                • Not to intentionally transfer, distribute or
                                allow the Services to be downloaded for use
                                other than as specified herein.
                            </p>
                            <p></p>
                            <p></p>
                            <p>
                                Representations and Warranties KHARDL
                                acknowledges that it will be:
                            </p>
                            <p>
                                • Responsible for technical support and repair
                                of malfunctions and problems that may occur as
                                quickly as possible.
                            </p>
                            <p>
                                • Responsible for the periodic maintenance of
                                the "KHARDL" system
                            </p>
                            <p></p>
                            <p>
                                • Responsible for managing the infrastructure of
                                servers and their services provided by a third
                                party.
                            </p>
                            <p>
                                • Committed to taking all measures and making
                                every effort to ensure the functioning of the
                                third party services associated with "KHARDL"
                            </p>
                            <p></p>
                            <p>
                                The Client represents and warrants that it will:
                            </p>
                            <p></p>
                            <p>
                                • Complies with all laws and regulations in
                                force in his country.
                            </p>
                            <p></p>
                            <p>
                                • Provides correct and accurate information to
                                "Khardl" and updates it periodically.
                            </p>
                            <p></p>
                            <p>
                                • Review and comply with any notices sent
                                through "Khardl" regarding its use of the
                                services provided "Khardl".
                            </p>
                            <p></p>
                            <p>
                                • It will not duplicate sublicenses, issue,
                                publish, transfer, distribute, perform, offer,
                                sell, or reclassify the Khardl Services, nor
                                will it transfer or commercially exploit the
                                Service, except as permitted under this
                                contract.
                            </p>
                            <p> </p>
                            <p>
                                • It will not use the information, content or
                                any data it accesses or obtains through the
                                Khardl Services for any other purpose except for
                                commercial use and will use the System and the
                                Service exclusively for its own purposes and
                                will not sell it to any third party (including
                                but not limited to providing any Service to any
                                other person).
                            </p>
                            <p></p>
                            <p>
                                • Uses the Service or App for lawful purposes
                                only, and will not use the Services to damage,
                                harm, harass or trespass on the property of
                                others or for any illegal purpose.
                            </p>
                            <p>
                                • It will not hinder the proper operation of the
                                "Khardl" system.
                            </p>
                            <p></p>
                            <p>
                                • It will not attempt to harm the Service or the
                                App in any way.
                            </p>
                            <p></p>
                            <p>
                                • The system or other content will not be copied
                                or distributed without the prior written
                                permission of Khardl.
                            </p>
                            <p></p>
                            <p>
                                • Be responsible for all login information for
                                his account such as usernames or passwords.
                            </p>
                            <p></p>
                            <p>
                                • Provides all evidence proving his identity to
                                "Khardl". Intellectual Property Rights
                            </p>
                            <p>
                                • "KHARDL" complies with the intellectual
                                property rights of customers from the content
                                that they have created through their stores and
                                applications, whether they were owned by them
                                before or after the establishment of the site or
                                application.
                            </p>
                            <p></p>
                            <p>
                                • The Merchant agrees to the intellectual
                                property rights of KHARDL, including the
                                platform, and other words, logos and symbols of
                                KHARDL or displayed on KHARDL, as KHARDL, and
                                each right that follows KHARDL, are protected by
                                intellectual property rights and trademark laws
                                and are the exclusive property of KHARDL and in
                                no way may they be infringed or used without
                                authorization from the KHARDL administration ,
                                Khardl can use your logo and pictures for
                                marketing purposes.
                            </p>
                            <p></p>
                            <p>propulsion</p>
                            <p></p>
                            <p>
                                Khardl undertakes to provide prices for the
                                Services in advance before and after
                                subscription, and it is your responsibility to
                                stay informed of the current prices of the
                                services provided.
                            </p>
                            <p>
                                As a customer, you must pay for the services by
                                bank transfer or credit cards and authorize the
                                card issuer to pay, as soon as the service is
                                provided to you. You are solely responsible for
                                the timely payment of all fees and acknowledge
                                that any amount paid is non-refundable.
                            </p>
                            <p></p>
                            <p>Compensation</p>
                            <p></p>
                            <p>
                                By agreeing to these User Terms and using the
                                System or Service, you agree to be fully liable
                                for damages arising out of or in connection
                                with:
                            </p>
                            <p> </p>
                            <p>
                                1. Your violation or breach of any provision of
                                these Terms of User or any applicable law or
                                regulation, whether or not referred to in these
                                Terms and Conditions of Use.
                            </p>
                            <p></p>
                            <p>
                                2. Violate any rights of third parties,
                                including service providers.
                            </p>
                            <p></p>
                            <p>
                                3. Your use or misuse of any of the services
                                provided by KHARDL. . Legal Liability
                            </p>
                            <p>
                                The information, recommendations and/or services
                                provided to you on or through the Website,
                                Service and App are for general information
                                purposes only and do not constitute any advice.
                            </p>
                            <p>
                                KHARDL will keep the website, application and
                                contents as correct and up to date.
                            </p>
                            <p></p>
                            <p>
                                KHARDL shall not be liable for any damages
                                resulting from the use (or inability to use) the
                                Site or App, including damages caused by malware
                                or viruses that infect the general software
                                beyond its control, unless such damage is caused
                                by intentional misconduct or gross negligence on
                                the part of KHARDL.
                            </p>
                            <p></p>
                            <p>
                                The quality of the third-party services
                                associated with KHARDL is the responsibility of
                                the service provider. Under no circumstances
                                shall KHARDL assume any responsibility in
                                connection with or arising out of the services
                                provided by the Service Provider, nor shall
                                liability be accepted for any acts, actions,
                                conduct, omissions, or all of the foregoing, on
                                the part of the Service Providers.
                            </p>
                            <p>
                                Therefore, any complaints about the services
                                should be submitted to the service provider.
                                Modification of services
                            </p>
                            <p>
                                KHARDL reserves the right, at its sole
                                discretion, to do the following at any time:
                            </p>
                            <p></p>
                            <p>
                                • Change the Services or any materials
                                associated with them; and/or stop publishing
                                their Services.
                            </p>
                            <p>
                                • If KHARDL decides to stop publishing its
                                services, it may voluntarily replace the
                                services with other similar materials.
                            </p>
                            <p>
                                • If KHARDL decides to exclude and introduce
                                delivery companies to its platform. Security
                            </p>
                            <p>
                                You acknowledge that you are solely responsible
                                for the privacy of the Services, and you are
                                solely responsible for their use by anyone else
                                using your account and/or username, password or
                                access credentials. You agree to notify KHARDL
                                if you become aware of any loss, theft, fraud,
                                unauthorized use of any password, username, IP
                                address, or other methods of accessing the
                                Services and HADL undertakes to follow all
                                possible means to prevent or stop the damage.
                            </p>
                            <p></p>
                            <p>Dealings with third parties</p>
                            <p> </p>
                            <p>
                                While using the Website, Application and
                                Service, links to websites owned and controlled
                                by third parties may be provided from time to
                                time, for example, for example, tax certificate
                                or logo of payment companies or delivery
                                companies. These links take you outside the
                                site, application and service, knowing that
                                these sites have independent terms and
                                conditions as well as an independent privacy
                                policy, and are outside the control of KHARDL.
                            </p>
                            <p></p>
                            <p>
                                Please note that these other sites may send
                                their own cookies to users, collect their data,
                                or request personal information, and therefore,
                                we recommend that you check the terms of use or
                                privacy policies on those sites before using
                                them.
                            </p>
                            <p></p>
                            <p>Payment services for electronic payments</p>
                            <p></p>
                            <p>
                                • KHARDL provides online payment service through
                                its partners through the platform, and KHARDL
                                provides this service for the purpose of
                                facilitating operations and maintaining the
                                level of service, and financial settlements are
                                on a weekly basis with the following fees:
                            </p>
                            <p>
                                o 1.99% + SAR 1 per transaction on any card type
                            </p>
                            <p></p>
                            <p>
                                • In the event of any change in the payment
                                service fees, the customer will be notified
                                through the approved communication channels such
                                as e-mail thirty days in advance.
                            </p>
                            <p></p>
                            <p>
                                • The customer has no right to choose to provide
                                online payments except through payment gateways
                                linked to KHARDL.
                            </p>
                            <p></p>
                            <p>
                                • KHARDL has nothing to do if the payment method
                                chosen by the consumer is "cash".
                            </p>
                            <p></p>
                            <p>
                                • KHARDL has the right to stop or modify the
                                electronic payment service through which it is
                                provided directly, and stores will be notified
                                60 days in advance.
                            </p>
                            <p>
                                • In the event that there is a suspicion of
                                fraud by banks or credit card companies on the
                                transactions, KHARDL will provide all the
                                documents required by banks or credit card
                                companies, knowing that the decision to prove
                                the fraud is taken by those parties, and upon
                                proof, the amount will be deducted from the
                                customer by the bank.
                            </p>
                            <p></p>
                            <p>
                                • KHARDL provides payment service through its
                                partners and is therefore not responsible for
                                delayed operations in cases of returns and
                                others.
                            </p>
                            <p></p>
                            <p>Invalidity of one or more judgments</p>
                            <p></p>
                            <p>
                                The invalidity of any provision of these Terms
                                of User shall not affect the validity of the
                                other provisions contained therein.
                            </p>
                            <p>
                                In the event of any invalid provision in these
                                Terms of User or an unacceptable provision in
                                certain circumstances in accordance with the
                                criteria of reasonableness and fairness and only
                                to that extent, it shall operate in its place
                                between the parties by a provision that is
                                acceptable in
                            </p>
                            <p> </p>
                            <p>
                                all circumstances and complies with the
                                provisions of the void condition as far as
                                possible, taking into account the content and
                                purpose of these User Terms.
                            </p>
                            <p></p>
                            <p>Confidentiality of information</p>
                            <p></p>
                            <p>
                                KHARDL takes high-quality security standards to
                                protect all users and prevent access to
                                information unless the person is authorized to
                                access it. Also, KHARDL has no control over the
                                third-party services associated with it, such as
                                delivery companies, electronic payment gateways,
                                or software libraries on the site or
                                application, knowing that all these services
                                have independent terms and conditions and
                                privacy policy.
                            </p>
                            <p></p>
                            <p>Modification of Service and User Terms</p>
                            <p></p>
                            <p>
                                KHARDL reserves the right, in its sole
                                discretion, to modify or replace any provision
                                of these User Terms, or to change, suspend or
                                discontinue the Service or Application
                                (including without limitation, the provision of
                                any feature, database or content) at any time,
                                by posting a notice on the Site or by sending
                                you a notification through the Service,
                                Application or by email. KHARDL may also place
                                restrictions on certain features and services or
                                limit your access to portions of the Service or
                                the entire Service without notice or liability.
                            </p>
                            <p></p>
                            <p>Notification</p>
                            <p></p>
                            <p>
                                "KHARDL" may send notice by sending a public
                                notice about the service or application, by
                                sending an email to your postal address
                                registered in the account information with
                                "KHARDL", or by sending a correspondence by
                                regular mail to your address registered in the
                                account information with "KHARDL".
                            </p>
                            <p></p>
                            <p>Applicable Law and Dispute Resolution</p>
                            <p></p>
                            <p>
                                These User Terms shall be governed by and
                                applied to the settlement of any dispute, claim
                                or controversy arising out of or relating to
                                these User Terms or any violation thereof,
                                termination, execution, interpretation,
                                correctness or use of the Site, Service or App,
                                shall be governed by and construed in accordance
                                with the laws and regulations applicable in the
                                Kingdom of Saudi Arabia if the Customer is in
                                the Middle East.
                            </p>
                            <p></p>
                            <p>Contact Us</p>
                            <p></p>
                            <p>
                                If you have any questions regarding these User
                                Terms, the practices of this system, or your
                                dealings with the system, you can contact us via
                                Support@khardl.com
                            </p>
                            <p></p>
                            <p>Kingdom of Saudi Arabia – Riyadh</p>
                        </div>
                    ) : (
                        <div className="container">
                            <header className="grid grid-cols-3 max-md:block mb-4 items-center font-bold text-[20px] text-[var(--primary)]">
                                <div className="blog-goBack">
                                    <button
                                        onClick={onClose}
                                        className="flex items-center gap-1 max-md:gap-0 "
                                    >
                                        {Language === "en" ? (
                                            <span>
                                                <MdOutlineKeyboardArrowLeft
                                                    size={26}
                                                />
                                            </span>
                                        ) : (
                                            <span>
                                                <MdOutlineKeyboardArrowRight
                                                    size={26}
                                                />
                                            </span>
                                        )}
                                        <span className="max-md:!font-normal max-md:text-[18px]">
                                            {Language === "en"
                                                ? "Back"
                                                : "الرجوع"}
                                        </span>
                                    </button>
                                </div>
                                <h1 className="blog-title text-center max-sm:text-xl ">
                                    <p>الشروط والأحكام لـKhardl</p>
                                </h1>
                            </header>
                            <p>
                                تمثل هذه الضوابط والشروط اتفاق رسمي “عقد” بين
                                “خردل- Khardl, Inc.” والمسجلة في المملكة العربية
                                السعودية بإسم شركة دنف المحدودة ذات سجل تجاري
                                رقم: 1010794210 ، وتحكم شروط المستخدم هذه
                                استخدامكم لخدمات خردل والتي هي عبارة منصة
                                إلكترونية تعمل كبوابة إلكترونية تتيح للعملاء
                                إستقبال الطلبات وإدارتها (“الخدمات”) حيث أن
                                استخدام أي شخصٍ كان لخردل سواءً كان تاجراً أو
                                مستهلكاً أو غير ذلك فإن هذا يُعد موافقة وقبول
                                منه وهو بكامل أهليته المعتبرة شرعاً ونظاماً
                                وقانوناً لكافة مواد وبنود وأحكام هذه الاتفاقية
                                وهو تأكيد لالتزامكم بأنظمتها ولما ذُكر فيها،
                                ونشير إليكم بأن خردل قد تكون عبارة عن ( موقع
                                إلكتروني أو تطبيق على الهواتف المحمولة أو منصة
                                إلكترونية ) وتعتبر هذه الاتفاقية سارية المفعول
                                ونافذة بمجرد قيامكم بالموافقة عليها والبدء في
                                الإشتراك في خردل.
                            </p>
                            <p>تمهيد</p>
                            <p>
                                • “خردل” يقصَد بهذه العبارة شركة دنف المحدودة،
                                ويشمل هذا التعريف كافة أشكال شركة دنف المحدودة
                                على الشبكة العنكبوتية، سواءً كانت تطبيق
                                الكتروني، أو موقع الكتروني على الشبكة
                                العنكبوتية.
                            </p>
                            <p>
                                • “العميل” يقصَد بهذه العبارة كل تاجر يشترك في
                                خردل وفي خدمات خردل.
                            </p>
                            <p>
                                • “المستهلك” يقصَد بهذه العبارة كل مستهلك يقوم
                                بشراء المنتج أو الخدمة من العميل وذلك عن طريق
                                متجر التاجر الالكتروني الذي أسسه عبر خردل.
                            </p>
                            <p>
                                • “الاتفاقية” يقصَد بهذه العبارة قواعد وشروط
                                وأحكام استخدام منصة خردل، أي كافة أحكام وشروط
                                هذه الاتفاقية، والتي تحكم وتنظّم العلاقة فيما
                                بين أطراف هذه الاتفاقية.
                            </p>
                            <p>
                                • “مزود الخدمة” يقصَد بهذه العبارة الخدمات التي
                                تقوم خردل بتوفيرها للعملاء عن طريق أطراف ثالثة ،
                                ويُقصد بـ توفير الخدمات أي مجرد توفير الربط بين
                                العميل ومزود الخدمة.
                            </p>
                            <p>أحقية الحصول على الخدمات</p>
                            <p>
                                • أنت تقر وتضمن التالي: أنه لم يسبق أن تم تعطيل
                                استخدامك لخدمات خردل أو منعك من استخدامها في أي
                                وقت من الأوقات.
                            </p>
                            <p>
                                • أنك تتمتع بكامل القوة والسلطة للتعاقد وأنك
                                بذلك لن تكون منتهكاً لأي قانون أو إتفاقية.
                            </p>
                            <p>نطاق الترخيص</p>
                            <p>
                                تمنح خردل العميل ترخيص غير حصري، وغير قابل
                                للتحويل، وغير قابل للتنازل، وغير قابل للترخيص من
                                الباطن وغير قابل للإلغاء وذلك للحصول على خدماتنا
                                واستخدامها .
                            </p>
                            <p>
                                • عدم إتاحة الخدمات أو تأجير، أو استئجار أو
                                تخصيص أو إعادة بيع، أو توزيع أو ترخيص من الباطن
                                لهذه الخدمات إلى أي طرف ثالث.
                            </p>
                            <p>
                                • عدم تعديل، أو اجتزاء، أو ترجمة، أو تلخيص، أو
                                إنشاء عمل فرعي يقوم على فك، أو تنفيذ هندسة عكسية
                                لتصميم تطبيق خردل أو خلاف ذلك من تحديد أو محاولة
                                تحديد أو محاولة الوصول إلى شفرة المصدر أو
                                التصميم الداخلي للخدمات أو أي نص، أو صور الوسائط
                                المتعددة (صور، صوتيات، ملفات فيديو)، أو البيانات
                                أو غيرها من المعلومات التي تقدمها خردل أو الطرف
                                الثالث من مقدمي الخدمة.
                            </p>
                            <p>
                                • عدم حذف، أو تغيير، أو غير ذلك من التعديل على
                                أي حق من حقوق النشر أو غيرها من الإخطارات
                                الرسمية الواردة في الخدمات.
                            </p>
                            <p>
                                • عدم تعمد نقل، أو توزيع الخدمات، أو السماح
                                بتحميل الخدمات للاستخدام بخلاف ما هو محدد هنا.
                            </p>
                            <p>التعهدات والضمانات</p>
                            <p>تقر خردل بأنها سوف تكون:</p>
                            <p>
                                • مسؤولة عن الدعم الفني وإصلاح الأعطال والمشاكل
                                التي قد تحصل باقصى سرعة ممكنة.{" "}
                            </p>
                            <p>• مسؤولة عن الصيانة الدورية لنظام “خردل”</p>
                            <p>
                                • مسؤولة عن إدارة البنية التحتية لأجهزة الخوادم
                                وخدماتها التي يقدمها طرف ثالث.{" "}
                            </p>
                            <p>
                                • تلتزم باتخاذ كافة الإجراءات وبذل كل الجهود
                                لضمان عمل خدمات الطرف الثالث المرتبطة ب “خردل”{" "}
                            </p>
                            <p>يقر “العميل” ويضمن بأنه سوف:</p>
                            <p>
                                • يمتثل لكافة القوانين واللوائح المعمول بها في
                                دولته.
                            </p>
                            <p>
                                • يقدم معلومات صحيحة ودقيقة إلى “خردل – Khardl”
                                والقيام بتحديثها بشكل دوري.
                            </p>
                            <p>
                                • يراجع ويمتثل لأي إشعارات يتم إرسالها من خلال
                                “خردل – Khardl” فيما يتعلق بإستخدامه للخدمات
                                المقدمة “خردل – Khardl”.
                            </p>
                            <p>
                                • لن يقوم بتكرار تراخيص من الباطن، أو إصدار، أو
                                نشر، أو نقل، أو توزيع، أو تنفيذ، أو عرض، أو بيع،
                                أو إعادة تصنيف خدمات “خردل – Khardl”، ولن يقوم
                                بنقل الخدمة أواستغلالها تجارياً، بإستثناء ما
                                يسمح به بموجب هذا العقد.
                            </p>
                            <p>
                                • لن يستخدم المعلومات، أو المحتوى أو أي بيانات
                                يصل إليها أو يحصل عليها من خلال خدمات “خردل –
                                Khardl” في أي غرض آخر إلا للإستعمال التجاري وسوف
                                يستخدم النظام والخدمة حصراً للأغراض الخاصة به
                                ولن يبيعها لأي طرف ثالث (بما في ذلك على سبيل
                                المثال لا الحصر تقديم أي خدمة إلى أي شخص آخر).
                            </p>
                            <p>
                                • يستخدم الخدمة أو التطبيق لأغراض مشروعة فقط،
                                ولن يستخدم الخدمات لإتلاف، إيذاء، مضايقة أو
                                التعدي على ممتلكات الآخرين أو أي غرض غير قانوني.
                            </p>
                            <p>
                                • لن يعرقل التشغيل السليم لنظام “خردل – Khardl”.
                            </p>
                            <p>
                                • لن يحاول إلحاق الضرر بالخدمة أو التطبيق بأي
                                شكل من الأشكال.
                            </p>
                            <p>
                                • لن ينسخ أو يوزع النظام أو المحتويات الأخرى دون
                                الحصول على إذن كتابي مسبق من “خردل – Khardl”.
                            </p>
                            <p>
                                • يكون مسؤولاً عن جميع معلومات الدخول لحسابه مثل
                                اسماء المستخدمين أو كلمات المرور.{" "}
                            </p>
                            <p>
                                • يقدم كافة الدلائل التي تثبت هويته لـ “خردل –
                                Khardl”.
                            </p>
                            <p>حقوق الملكية الفكرية</p>
                            <p>
                                • توافق “خردل” حقوق الملكية الفكرية الخاصة
                                بالعملاء من محتوى والتي كوّنوها عبر متاجرهم
                                وتطبيقاتهم، سواءً كانت مملوكة لهم قبل تأسيس
                                الموقع أو التطبيق أم بعد تأسيسه.
                            </p>
                            <p>
                                • يوافق التاجر على حقوق الملكية الفكرية الخاصة
                                بخردل، والتي من ضمنها المنصة، والكلمات والشعارات
                                والرموز الأخرى الخاصة بخردل أو المعروضة على
                                خردل، حيث أن خردل، وكل حق يتبع خردل، هي حقوق
                                محمية بموجب حقوق الملكية الفكرية وقوانين
                                العلامات التجارية وتعد ملكية خالصة لخردل ولا يحق
                                بأي حال من الأحوال التعدي عليها أو استخدامها دون
                                تفويض من إدارة خردل كما يحق لخردل استخدام
                                الشعارات و الصور الخاصة بك لغرض التسويق{" "}
                            </p>
                            <p>الدفع</p>
                            <p>
                                تتعهد خردل بتوفير أسعار الخدمات مسبقًا قبل
                                الإشتراك وبعده، ويقع على عاتقك مسؤولية البقاء
                                على معرفة بالأسعار الحالية للخدمات المقدمة.
                            </p>
                            <p>
                                كعميل، يتوجب عليك دفع قيمة الخدمات عن طريق
                                الحوالات البنكية أو البطاقات الائتمانية و تصرح
                                للجهة مصدرة البطاقة بالدفع ، وفور تقديم الخدمة
                                لك. وتتحمل وحدك مسؤولية دفع جميع الرسوم في
                                موعدها و تقر بأن أي مبلغ يُدفع لا يمكن استرداده.
                            </p>
                            <p>التعويض</p>
                            <p>
                                بموافقتك على شروط المستخدم الماثلة واستخدام
                                النظام أو الخدمة، فإنك توافق على تحمل المسؤولية
                                بالكامل عن الأضرار التي تنشأ عن أو ترتبط بما
                                يلي:
                            </p>
                            <p>
                                1. انتهاكك أو مخالفتك لأي شرط من شروط المستخدم
                                الماثلة هذه أو لأي قانون أو لوائح معمول بها،
                                سواء أشير إليها في شروط وأحكام الاستخدام هذه أم
                                لا.
                            </p>
                            <p>
                                2. انتهاكك لأي حقوق تخص الغير، بما في ذلك مُقدمي
                                الخدمات.{" "}
                            </p>
                            <p>
                                3. استخدامك أو إساءة استخدامك لأي من الخدمات
                                المقدمة من خردل. .
                            </p>
                            <p>المسؤولية القانونية</p>
                            <p>
                                المعلومات والتوصيات والخدمات أو أي منها التي
                                قُدمت لك على أو من خلال موقع الويب والخدمة
                                والتطبيق هي لأغراض المعلومات العامة فقط ولا تمثل
                                أي نصيحة. ستحافظ خردل قدر الإمكان على صحة وتحديث
                                الموقع والتطبيق ومحتوياته.{" "}
                            </p>
                            <p>
                                لا تتحمل خردل المسؤولية عن أي أضرار تنتج عن
                                استخدام (أو عدم القدرة على استخدام) الموقع أو
                                التطبيق، بما في ذلك الأضرار التي تسببها البرامج
                                الضارة أو الفيروسات التي تصيب البرمجيات عامةً
                                الخارجة عن الإرادة، ما لم يكن هذا الضرر ناتج عن
                                سوء سلوك عمدي أو عن إهمال جسيم من جانب خردل.
                            </p>
                            <p>
                                تقع مسؤولية جودة خدمات الطرف الثالث المرتبطة
                                بخردل على عاتق مقدم الخدمة. لا تتحمل خردل تحت أي
                                ظرف من الظروف أي مسؤولية تتعلق بالخدمات التي
                                يقدمها مقدم الخدمة أو تنشأ عنها، كما لا تقبل
                                المسؤولية عن أي أفعال أو تصرفات أو سلوك أو
                                إهمال، أو جميع ما سبق، من جانب مقدمي الخدمة. ومن
                                ثم، فإن أي شكاوى بشأن الخدمات ينبغي تقديمها على
                                مقدم الخدمة.
                            </p>
                            <p>تعديل الخدمات</p>
                            <p>
                                تحتفظ خردل بحقها، وبإرادتها المنفردة، بأن تقوم
                                في أي وقت بالآتي:
                            </p>
                            <p>
                                • تغيير الخدمات أو أي مواد مرتبطة بها؛ و/ أو
                                إيقاف نشر خدماتها.
                            </p>
                            <p>
                                • إذا قررت خردل إيقاف نشر خدماتها، فإنها قد تقوم
                                بإرادتها باستبدال الخدمات بمواد أخرى مشابهة.
                            </p>
                            <p>
                                • اذا قررت خردل استبعاد وإدخال شركات توصيل
                                لمنصتها.{" "}
                            </p>
                            <p>الأمان</p>
                            <p>
                                إنك تقر بتحملك المسئولية منفرداً عن خصوصية
                                الخدمات، وتكون مسئولاً منفرداً عن استخدامها من
                                قبل أي شخص آخر باستخدام حسابك و/أو اسم المستخدم
                                أو كلمة المرور أو مسوغات الوصول الخاصة بك. كما
                                أنك توافق على إخطار خردل إذا أصبحت على علم بأي
                                خسارة، أو سرقة، أو احتيال، أو استخدام غير مصرح
                                به لأي كلمة مرور، أو اسم مستخدم أو عنوان
                                بروتوكول الانترنت IP، أو غير ذلك من أساليب
                                الوصول إلى الخدمات وتتعهد خردل باتباع كل السبل
                                الممكنة لمنع أو ايقاف الضرر.{" "}
                            </p>
                            <p>التعاملات مع الغير</p>
                            <p>
                                أثناء استخدام موقع الويب والتطبيق والخدمة، قد
                                يتم من آن لآخر توفير ارتباطات لمواقع ويب يمتلكها
                                ويتحكم فيها الغير على سبيل المثال للحصر، شهادة
                                الضريبة أو شعار شركات المدفوعات أو شركات
                                التوصيل. تنتقل بك تلك الارتباطات إلى خارج الموقع
                                والتطبيق والخدمة علماً بأن تلك المواقع لها شروط
                                وأحكام مستقلة وكذلك سياسة خصوصية مستقلة، وهي
                                خارج نطاق سيطرة خردل.
                            </p>
                            <p>
                                يُرجى ملاحظة أن تلك المواقع الأخرى قد ترسل ملفات
                                تعريف الارتباط الخاصة بها إلى المستخدمين أو تجمع
                                بياناتهم أو تطلب معلومات شخصية، ومن ثم، نوصيك
                                بالتحقق من شروط الاستخدام أو سياسات الخصوصية
                                الموجودة على تلك المواقع قبل استخدامها.
                            </p>
                            <p>خدمات السداد للمدفوعات الإلكترونية </p>
                            <p>
                                • تقوم خردل توفير خدمة المدفوعات الإلكترونية عبر
                                شركائها من خلال المنصة وتوفر خردل هذه الخدمة
                                بغرض تسهيل العمليات والمحافظة على مستوى الخدمة
                                وتكون التسويات المالية على أساس أسبوعي بالرسوم
                                التالية:
                            </p>
                            <p>
                                o 1.99% + 1 ريال على كل عملية مهما كان نوع بطاقة
                                العميل
                            </p>
                            <p>
                                • في حال كان هناك أي تغيير على رسوم خدمة
                                المدفوعات، سيتم إبلاغ العميل من خلال قنوات
                                التواصل المعتمدة مثل الإيميل قبلها بثلاثين
                                يوماً.{" "}
                            </p>
                            <p>
                                • لا يحق للعميل اختيار توفير المدفوعات
                                الإلكترونية الا من خلال بوابات المدفوعات
                                الإلكترونية المرتبطة بخردل.{" "}
                            </p>
                            <p>
                                • ليس لخردل علاقة في حال كانت طريقة الدفع التي
                                اختارها المستهلك هي “نقداً”.{" "}
                            </p>
                            <p>
                                • يحق لخردل ايقاف أو تعديل خدمة المدفوعات
                                الإلكترونية التي تقدم من خلالها مباشرة وسيتم
                                إبلاغ المتاجر قبلها ب ٦٠ يوماً.{" "}
                            </p>
                            <p>
                                • في حال كان هناك اشتباه احتيال من قبل البنوك أو
                                شركات البطاقات الإئتمانية على العمليات، فإن خردل
                                ستقدم كل المستندات التي تطلبها البنوك أو شركات
                                البطاقات الإئتمانية علماً بأن قرار أثبات عملية
                                الإحتيال تتخذه تلك الجهات، وعند الإثبات، سيتم
                                خصم المبلغ من العميل من قبل البنك.{" "}
                            </p>
                            <p>
                                • خردل تقدم خدمة المدفوعات عبر شركائها وعليه هي
                                ليست مسؤولة عن تأخر العمليات في حالات الإسترجاع
                                وغيرها.{" "}
                            </p>
                            <p>بطلان حكم أو أكثر</p>
                            <p>
                                لا يؤثر بطلان أي حكم من أحكام شروط المستخدم
                                الماثلة على صحة باقي الأحكام الأخرى الواردة
                                فيها.
                            </p>
                            <p>
                                في حالة وجود أي حكم باطل في شروط المستخدم
                                الماثلة أو وجود حكم غير مقبول في ظروف معينة
                                وفقًا لمعايير المعقولية والعدالة وإلى هذا المدى
                                فقط، يُعمل بدلاً منه بين الطرفين بحكم يكون
                                مقبولاً مراعاةً لجميع الظروف ويتوافق مع أحكام
                                الشرط الباطل قدر الإمكان، مع مراعاة محتوى شروط
                                المستخدم الماثلة وغرضها.
                            </p>
                            <p>سرية المعلومات</p>
                            <p>
                                تتخذ خردل المعايير الأمنية ذات الجودة العالية
                                لحماية المستخدمين كافة ومنع الوصول للمعلومات
                                مالم يكون الشخص مخولاً للوصول لها. كما أن خردل
                                ليس لها تحكم على خدمات الطرف الثالث المرتبطة بها
                                مثل شركات التوصيل أو بوابات المدفوعات
                                الإلكترونية أو المكتبات البرمجية التي في الموقع
                                أو التطبيق علماً بأن كل تلك الخدمات لها شروط
                                وأحكام وسياسة خصوصية مستقلة.{" "}
                            </p>
                            <p>تعديل الخدمة وشروط المستخدم</p>
                            <p>
                                تحتفظ خردل لنفسها بالحق، وفقًا لتقديرها وحدها،
                                في تعديل أي شرط من شروط المستخدم الماثلة أو
                                استبداله، أو تغيير الخدمة أو التطبيق أو تعليقهما
                                أو إيقافهما (بما في ذلك على سبيل المثال لا
                                الحصر، توفير أي ميزة أو قاعدة بيانات أو محتوى)
                                في أي وقت، وذلك بنشر إخطار على الموقع أو بإرسال
                                إخطار لك من خلال الخدمة أو التطبيق أو عبر البريد
                                الإلكتروني. كما يجوز لـ ” خردل” أن تضع قيودًا
                                على ميزات وخدمات مُعيَّنة أو تقصر وصولك إلى
                                أجزاء من الخدمة أو الخدمة بأكملها دون إخطار أو
                                مسؤولية.
                            </p>
                            <p>الإخطار</p>
                            <p>
                                يجوز لـ ”خردل” أن ترسل إخطارًا عن طريق إرسال
                                إخطار عام عن الخدمة أو التطبيق، أو بإرسال بريد
                                إلكتروني إلى عنوانك البريدي المُسجل في معلومات
                                الحساب لدى ”خردل” ، أو بإرسال مكاتبة بالبريد
                                العادي على عنوانك المسجل في معلومات الحساب لدى
                                ”خردل”.
                            </p>
                            <p>القانون المعمول به وحل النزاعات</p>
                            <p>
                                تخضع شروط المستخدم الماثلة ويطبق على تسوية أي
                                نزاع أو مطالبة أو خلاف ينشأ عن شروط المستخدم
                                الماثلة أو يتعلق بها أو أي انتهاك لها أو إنهائها
                                أو تنفيذها أو تفسيرها أو صحتها أو استخدام الموقع
                                أو الخدمة أو التطبيق، للقوانين والأنظمة المطبقة
                                في المملكة العربية السعودية وتفسر وفقا لها في
                                حال كان العميل في منطقة الشرق الأوسط.
                            </p>
                            <p>للتواصل معنا</p>
                            <p>
                                إذا كان لديك أي أسئلة بشأن شروط المستخدم هذه، أو
                                الممارسات بهذا النظام، أو تعاملاتك مع النظام،
                                يمكنكم التواصل معنا عبر Support@khardl.com{" "}
                            </p>
                            <p>المملكة العربية السعودية – الرياض</p>
                        </div>
                    )}
                </div>
            </div>
        </>
    );
};

export default Privacy;
