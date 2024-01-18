import React from "react";
import ContactUsCover from "../../assets/ContactUsCover.webp";
import "./style.css";
import { useSelector } from "react-redux";
import {
  MdOutlineKeyboardArrowLeft,
  MdOutlineKeyboardArrowRight,
} from "react-icons/md";
import { Link, useNavigate } from "react-router-dom";
import NavbarRestuarant from "../../../../tenant/src/pages/RestuarantPage/components/NavbarRestuarant";

const Privacy = ({ onClose }) => {
  const Language = useSelector((state) => state.languageMode.languageMode);
  const navigate = useNavigate();

  const handleBack = () => {
    navigate("/");
  };
  return (
    <div>
      <NavbarRestuarant />
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
              <header className="grid grid-cols-3 max-md:block  mb-4 items-center font-bold text-[20px] text-[var(--primary)]">
                <div className="">
                  <button
                    onClick={onClose}
                    className="flex items-center gap-1 max-md:gap-0 "
                  >
                    {Language === "en" ? (
                      <span>
                        <MdOutlineKeyboardArrowLeft size={26} />
                      </span>
                    ) : (
                      <span>
                        <MdOutlineKeyboardArrowRight size={26} />
                      </span>
                    )}
                    <span
                      className="max-md:!font-normal max-md:text-[18px]"
                      onClick={handleBack}
                    >
                      {Language === "en" ? "Back" : "الرجوع"}
                    </span>
                  </button>
                </div>
                <h1 className="text-center max-sm:text-xl ">
                  Privacy Policy for Khardl
                </h1>
              </header>
              <p>Privacy Policy</p>
              <p>Last updated: September 07, 2023</p>
              <p>
                This Privacy Policy describes Our policies and procedures on the
                collection, use and disclosure of Your information when You use
                the Service and tells You about Your privacy rights and how the
                law protects You.
              </p>
              <p>
                We use Your Personal data to provide and improve the Service. By
                using the Service, You agree to the collection and use of
                information in accordance with this Privacy Policy.
              </p>
              <p>Interpretation and Definitions</p>
              <p>Interpretation</p>
              <p>
                The words of which the initial letter is capitalized have
                meanings defined under the following conditions. The following
                definitions shall have the same meaning regardless of whether
                they appear in singular or in plural.
              </p>
              <p>Definitions</p>
              <p>For the purposes of this Privacy Policy:</p>
              <p>
                • Account means a unique account created for You to access our
                Service or parts of our Service.
              </p>
              <p>
                • Affiliate means an entity that controls, is controlled by or
                is under common control with a party, where "control" means
                ownership of 50% or more of the shares, equity interest or other
                securities entitled to vote for election of directors or other
                managing authority.
              </p>
              <p>
                • Company (referred to as either "the Company", "We", "Us" or
                "Our" in this Agreement) refers to Dannf Limited Company, SAUDI
                ARABIA , RIYADH , PRINCE MOHAMMED BIN SALMAN STREET.
              </p>
              <p>
                • Cookies are small files that are placed on Your computer,
                mobile device or any other device by a website, containing the
                details of Your browsing history on that website among its many
                uses.
              </p>
              <p>• Country refers to: Saudi Arabia</p>
              <p>
                • Device means any device that can access the Service such as a
                computer, a cellphone or a digital tablet.
              </p>
              <p>
                • Personal Data is any information that relates to an identified
                or identifiable individual.
              </p>
              <p>• Service refers to the Website.</p>
              <p>
                • Service Provider means any natural or legal person who
                processes the data on behalf of the Company. It refers to
                third-party companies or individuals employed by the Company to
                facilitate the Service, to provide the Service on behalf of the
                Company, to perform services related to the Service or to assist
                the Company in analyzing how the Service is used.
              </p>
              <p>
                • Usage Data refers to data collected automatically, either
                generated by the use of the Service or from the Service
                infrastructure itself (for example, the duration of a page
                visit).
              </p>
              <p>
                • Website refers to Khardl, accessible from
                https://www.khardl.com
              </p>
              <p>
                • You means the individual accessing or using the Service, or
                the company, or other legal entity on behalf of which such
                individual is accessing or using the Service, as applicable.
              </p>
              <p>Collecting and Using Your Personal Data</p>
              <p>Types of Data Collected</p>
              <p>Personal Data</p>
              <p>
                While using Our Service, We may ask You to provide Us with
                certain personally identifiable information that can be used to
                contact or identify You. Personally identifiable information may
                include, but is not limited to:
              </p>
              <p>• Email address</p>
              <p>• First name and last name</p>
              <p>• Phone number</p>
              <p>• Address, State, Province, ZIP/Postal code, City</p>
              <p>• Usage Data</p>
              <p>Usage Data</p>
              <p>
                Usage Data is collected automatically when using the Service.
              </p>
              <p>
                Usage Data may include information such as Your Device's
                Internet Protocol address (e.g. IP address), browser type,
                browser version, the pages of our Service that You visit, the
                time and date of Your visit, the time spent on those pages,
                unique device identifiers and other diagnostic data.
              </p>
              <p>
                When You access the Service by or through a mobile device, We
                may collect certain information automatically, including, but
                not limited to, the type of mobile device You use, Your mobile
                device unique ID, the IP address of Your mobile device, Your
                mobile operating system, the type of mobile Internet browser You
                use, unique device identifiers and other diagnostic data.
              </p>
              <p>
                We may also collect information that Your browser sends whenever
                You visit our Service or when You access the Service by or
                through a mobile device.
              </p>
              <p>Tracking Technologies and Cookies</p>
              <p>
                We use Cookies and similar tracking technologies to track the
                activity on Our Service and store certain information. Tracking
                technologies used are beacons, tags, and scripts to collect and
                track information and to improve and analyze Our Service. The
                technologies We use may include:
              </p>
              <p>
                • Cookies or Browser Cookies. A cookie is a small file placed on
                Your Device. You can instruct Your browser to refuse all Cookies
                or to indicate when a Cookie is being sent. However, if You do
                not accept Cookies, You may not be able to use some parts of our
                Service. Unless you have adjusted Your browser setting so that
                it will refuse Cookies, our Service may use Cookies.
              </p>
              <p>
                • Web Beacons. Certain sections of our Service and our emails
                may contain small electronic files known as web beacons (also
                referred to as clear gifs, pixel tags, and single-pixel gifs)
                that permit the Company, for example, to count users who have
                visited those pages or opened an email and for other related
                website statistics (for example, recording the popularity of a
                certain section and verifying system and server integrity).
              </p>
              <p>
                Cookies can be "Persistent" or "Session" Cookies. Persistent
                Cookies remain on Your personal computer or mobile device when
                You go offline, while Session Cookies are deleted as soon as You
                close Your web browser.{" "}
              </p>
              <p>
                We use both Session and Persistent Cookies for the purposes set
                out below:
              </p>
              <p>• Necessary / Essential Cookies</p>
              <p>Type: Session Cookies</p>
              <p>Administered by: Us</p>
              <p>
                Purpose: These Cookies are essential to provide You with
                services available through the Website and to enable You to use
                some of its features. They help to authenticate users and
                prevent fraudulent use of user accounts. Without these Cookies,
                the services that You have asked for cannot be provided, and We
                only use these Cookies to provide You with those services.
              </p>
              <p>• Cookies Policy / Notice Acceptance Cookies</p>
              <p>Type: Persistent Cookies</p>
              <p>Administered by: Us</p>
              <p>
                Purpose: These Cookies identify if users have accepted the use
                of cookies on the Website.
              </p>
              <p>• Functionality Cookies</p>
              <p>Type: Persistent Cookies</p>
              <p>Administered by: Us</p>
              <p>
                Purpose: These Cookies allow us to remember choices You make
                when You use the Website, such as remembering your login details
                or language preference. The purpose of these Cookies is to
                provide You with a more personal experience and to avoid You
                having to re-enter your preferences every time You use the
                Website.
              </p>
              <p>
                For more information about the cookies we use and your choices
                regarding cookies, please visit our Cookies Policy or the
                Cookies section of our Privacy Policy.
              </p>
              <p>Use of Your Personal Data</p>
              <p>
                The Company may use Personal Data for the following purposes:
              </p>
              <p>
                • To provide and maintain our Service, including to monitor the
                usage of our Service.
              </p>
              <p>
                • To manage Your Account: to manage Your registration as a user
                of the Service. The Personal Data You provide can give You
                access to different functionalities of the Service that are
                available to You as a registered user.
              </p>
              <p>
                • For the performance of a contract: the development, compliance
                and undertaking of the purchase contract for the products, items
                or services You have purchased or of any other contract with Us
                through the Service.
              </p>
              <p>
                • To contact You: To contact You by email, telephone calls, SMS,
                or other equivalent forms of electronic communication, such as a
                mobile application's push notifications regarding updates or
                informative communications related to the functionalities,
                products or contracted services, including the security updates,
                when necessary or reasonable for their implementation.
              </p>
              <p>
                • To provide You with news, special offers and general
                information about other goods, services and events which we
                offer that are similar to those that you have already purchased
                or enquired about unless You have opted not to receive such
                information.
              </p>
              <p>
                • To manage Your requests: To attend and manage Your requests to
                Us.
              </p>
              <p>
                • For business transfers: We may use Your information to
                evaluate or conduct a merger, divestiture, restructuring,
                reorganization, dissolution, or other sale or transfer of some
                or all of Our assets, whether as a going concern or as part of
                bankruptcy, liquidation, or similar proceeding, in which
                Personal Data held by Us about our Service users is among the
                assets transferred.
              </p>
              <p>
                • For other purposes: We may use Your information for other
                purposes, such as data analysis, identifying usage trends,
                determining the effectiveness of our promotional campaigns and
                to evaluate and improve our Service, products, services,
                marketing and your experience.
              </p>
              <p>
                We may share Your personal information in the following
                situations:
              </p>
              <p>
                • With Service Providers: We may share Your personal information
                with Service Providers to monitor and analyze the use of our
                Service, to contact You.
              </p>
              <p>
                • For business transfers: We may share or transfer Your personal
                information in connection with, or during negotiations of, any
                merger, sale of Company assets, financing, or acquisition of all
                or a portion of Our business to another company.
              </p>
              <p>
                • With Affiliates: We may share Your information with Our
                affiliates, in which case we will require those affiliates to
                honor this Privacy Policy. Affiliates include Our parent company
                and any other subsidiaries, joint venture partners or other
                companies that We control or that are under common control with
                Us.
              </p>
              <p>
                • With business partners: We may share Your information with Our
                business partners to offer You certain products, services or
                promotions.
              </p>
              <p>
                • With other users: when You share personal information or
                otherwise interact in the public areas with other users, such
                information may be viewed by all users and may be publicly
                distributed outside.
              </p>
              <p>
                • With Your consent: We may disclose Your personal information
                for any other purpose with Your consent.
              </p>
              <p>Retention of Your Personal Data</p>
              <p>
                The Company will retain Your Personal Data only for as long as
                is necessary for the purposes set out in this Privacy Policy. We
                will retain and use Your Personal Data to the extent necessary
                to comply with our legal obligations (for example, if we are
                required to retain your data to comply with applicable laws),
                resolve disputes, and enforce our legal agreements and policies.
              </p>
              <p>
                The Company will also retain Usage Data for internal analysis
                purposes. Usage Data is generally retained for a shorter period
                of time, except when this data is used to strengthen the
                security or to improve the functionality of Our Service, or We
                are legally obligated to retain this data for longer time
                periods.
              </p>
              <p>Transfer of Your Personal Data</p>
              <p>
                Your information, including Personal Data, is processed at the
                Company's operating offices and in any other places where the
                parties involved in the processing are located. It means that
                this information may be transferred to — and maintained on —
                computers located outside of Your state, province, country or
                other governmental jurisdiction where the data protection laws
                may differ than those from Your jurisdiction.
              </p>
              <p>
                Your consent to this Privacy Policy followed by Your submission
                of such information represents Your agreement to that transfer.
              </p>
              <p>
                The Company will take all steps reasonably necessary to ensure
                that Your data is treated securely and in accordance with this
                Privacy Policy and no transfer of Your Personal Data will take
                place to an organization or a country unless there are adequate
                controls in place including the security of Your data and other
                personal information.
              </p>
              <p>Delete Your Personal Data</p>
              <p>
                You have the right to delete or request that We assist in
                deleting the Personal Data that We have collected about You.
              </p>
              <p>
                Our Service may give You the ability to delete certain
                information about You from within the Service.
              </p>
              <p>
                You may update, amend, or delete Your information at any time by
                signing in to Your Account, if you have one, and visiting the
                account settings section that allows you to manage Your personal
                information. You may also contact Us to request access to,
                correct, or delete any personal information that You have
                provided to Us.
              </p>
              <p>
                Please note, however, that We may need to retain certain
                information when we have a legal obligation or lawful basis to
                do so.
              </p>
              <p>Disclosure of Your Personal Data</p>
              <p>Business Transactions</p>
              <p>
                If the Company is involved in a merger, acquisition or asset
                sale, Your Personal Data may be transferred. We will provide
                notice before Your Personal Data is transferred and becomes
                subject to a different Privacy Policy.
              </p>
              <p>Law enforcement</p>
              <p>
                Under certain circumstances, the Company may be required to
                disclose Your Personal Data if required to do so by law or in
                response to valid requests by public authorities (e.g. a court
                or a government agency).
              </p>
              <p>Other legal requirements</p>
              <p>
                The Company may disclose Your Personal Data in the good faith
                belief that such action is necessary to:
              </p>
              <p>• Comply with a legal obligation</p>
              <p>• Protect and defend the rights or property of the Company</p>
              <p>
                • Prevent or investigate possible wrongdoing in connection with
                the Service
              </p>
              <p>
                • Protect the personal safety of Users of the Service or the
                public
              </p>
              <p>• Protect against legal liability</p>
              <p>Security of Your Personal Data</p>
              <p>
                The security of Your Personal Data is important to Us, but
                remember that no method of transmission over the Internet, or
                method of electronic storage is 100% secure. While We strive to
                use commercially acceptable means to protect Your Personal Data,
                We cannot guarantee its absolute security.
              </p>
              <p>Children's Privacy</p>
              <p>
                Our Service does not address anyone under the age of 13. We do
                not knowingly collect personally identifiable information from
                anyone under the age of 13. If You are a parent or guardian and
                You are aware that Your child has provided Us with Personal
                Data, please contact Us. If We become aware that We have
                collected Personal Data from anyone under the age of 13 without
                verification of parental consent, We take steps to remove that
                information from Our servers.
              </p>
              <p>
                If We need to rely on consent as a legal basis for processing
                Your information and Your country requires consent from a
                parent, We may require Your parent's consent before We collect
                and use that information.
              </p>
              <p>Links to Other Websites</p>
              <p>
                Our Service may contain links to other websites that are not
                operated by Us. If You click on a third party link, You will be
                directed to that third party's site. We strongly advise You to
                review the Privacy Policy of every site You visit.
              </p>
              <p>
                We have no control over and assume no responsibility for the
                content, privacy policies or practices of any third party sites
                or services.
              </p>
              <p>Changes to this Privacy Policy</p>
              <p>
                We may update Our Privacy Policy from time to time. We will
                notify You of any changes by posting the new Privacy Policy on
                this page.
              </p>
              <p>
                We will let You know via email and/or a prominent notice on Our
                Service, prior to the change becoming effective and update the
                "Last updated" date at the top of this Privacy Policy.
              </p>
              <p>
                You are advised to review this Privacy Policy periodically for
                any changes. Changes to this Privacy Policy are effective when
                they are posted on this page.
              </p>
              <p>Contact Us</p>
              <p>
                If you have any questions about this Privacy Policy, You can
                contact us:
              </p>
              <p>• By email: info@khardl.com</p>
            </div>
          ) : (
            <div className="container">
              <header className="grid grid-cols-3 mb-4 max-md:block items-center font-bold text-[22px] text-[var(--primary)]">
                <div className="blog-goBack">
                  <button
                    onClick={onClose}
                    className="flex items-center gap-1 max-md:gap-0 "
                  >
                    {Language === "en" ? (
                      <span>
                        <MdOutlineKeyboardArrowLeft size={26} />
                      </span>
                    ) : (
                      <span>
                        <MdOutlineKeyboardArrowRight size={26} />
                      </span>
                    )}
                    <span className="max-md:!font-normal max-md:text-[18px]">
                      {Language === "en" ? "Back" : "الرجوع"}
                    </span>
                  </button>
                </div>
                <h1 className="blog-title text-center max-sm:text-xl ">
                  <p>سياسة الخصوصية لـKhardl</p>
                </h1>
              </header>
              <p>سياسة الخصوصية</p>
              <p>آخر تحديث: 07 سبتمبر 2023</p>
              <p>
                تصف سياسة الخصوصية هذه سياساتنا وإجراءاتنا بشأن جمع معلوماتك
                واستخدامها والكشف عنها عند استخدام الخدمة وتخبرك بحقوق الخصوصية
                الخاصة بك وكيف يحميك القانون.
              </p>
              <p>
                نحن نستخدم بياناتك الشخصية لتوفير الخدمة وتحسينها. باستخدام
                الخدمة، فإنك توافق على جمع واستخدام المعلومات وفقًا لسياسة
                الخصوصية هذه.
              </p>
              <p></p>
              <p>التفسير والتعاريف</p>
              <p>تفسير</p>
              <p>
                الكلمات التي يتم كتابة الحرف الأول منها بالأحرف الكبيرة لها
                معاني محددة وفقًا للشروط التالية. يكون للتعريفات التالية نفس
                المعنى بغض النظر عما إذا كانت تظهر بصيغة المفرد أو الجمع.
              </p>
              <p></p>
              <p>تعريفات</p>
              <p>لأغراض سياسة الخصوصية هذه:</p>
              <p>
                • الحساب يعني حسابًا فريدًا تم إنشاؤه لك للوصول إلى خدمتنا أو
                أجزاء من خدمتنا.
              </p>
              <p>
                • الشركة التابعة تعني كيان يسيطر أو يخضع لسيطرة أو يخضع لسيطرة
                مشتركة مع طرف ما، حيث تعني كلمة "السيطرة" ملكية 50% أو أكثر من
                الأسهم أو حصص الأسهم أو الأوراق المالية الأخرى التي يحق لها
                التصويت لانتخاب أعضاء مجلس الإدارة أو الإدارة الأخرى سلطة.
              </p>
              <p>
                • تشير الشركة (المشار إليها إما بـ "الشركة" أو "نحن" أو "نا" أو
                "خاصتنا" في هذه الاتفاقية) إلى شركة دنف المحدودة، المملكة
                العربية السعودية، الرياض، شارع الأمير محمد بن سلمان.
              </p>
              <p>
                • ملفات تعريف الارتباط هي ملفات صغيرة يتم وضعها على جهاز
                الكمبيوتر الخاص بك أو جهازك المحمول أو أي جهاز آخر عن طريق موقع
                ويب، وتحتوي على تفاصيل سجل التصفح الخاص بك على موقع الويب هذا من
                بين استخداماته المتعددة.
              </p>
              <p>• تشير الدولة إلى: المملكة العربية السعودية</p>
              <p>
                • الجهاز يعني أي جهاز يمكنه الوصول إلى الخدمة مثل جهاز كمبيوتر
                أو هاتف محمول أو جهاز لوحي رقمي.
              </p>
              <p>
                • البيانات الشخصية هي أي معلومات تتعلق بفرد محدد أو يمكن التعرف
                عليه.
              </p>
              <p>• تشير الخدمة إلى الموقع.</p>
              <p>
                • مقدم الخدمة يعني أي شخص طبيعي أو اعتباري يقوم بمعالجة البيانات
                نيابة عن الشركة. ويشير إلى شركات الطرف الثالث أو الأفراد
                العاملين لدى الشركة لتسهيل الخدمة، أو تقديم الخدمة نيابة عن
                الشركة، أو أداء الخدمات المتعلقة بالخدمة أو مساعدة الشركة في
                تحليل كيفية استخدام الخدمة.
              </p>
              <p>
                • تشير بيانات الاستخدام إلى البيانات التي يتم جمعها تلقائيًا،
                إما الناتجة عن استخدام الخدمة أو من البنية التحتية للخدمة نفسها
                (على سبيل المثال، مدة زيارة الصفحة).
              </p>
              <p>
                • يشير الموقع الإلكتروني إلى Khardl، ويمكن الوصول إليه من
                https://www.khardl.com
              </p>
              <p>
                • أنت تعني الفرد الذي يصل إلى الخدمة أو يستخدمها، أو الشركة، أو
                أي كيان قانوني آخر يقوم هذا الفرد بالنيابة عنه بالوصول إلى
                الخدمة أو استخدامها، حسب الاقتضاء.
              </p>
              <p>جمع واستخدام بياناتك الشخصية</p>
              <p>أنواع البيانات التي تم جمعها</p>
              <p>بيانات شخصية</p>
              <p>
                أثناء استخدام خدمتنا، قد نطلب منك تزويدنا ببعض معلومات التعريف
                الشخصية التي يمكن استخدامها للاتصال بك أو التعرف عليك. قد تتضمن
                معلومات التعريف الشخصية، على سبيل المثال لا الحصر، ما يلي:
              </p>
              <p>• عنوان البريد الإلكتروني</p>
              <p>• الاسم الأول واسم العائلة</p>
              <p>• رقم التليفون</p>
              <p>
                • العنوان، الولاية، المقاطعة، الرمز البريدي/الرمز البريدي،
                المدينة
              </p>
              <p>• بيانات الاستخدام</p>
              <p>بيانات الاستخدام</p>
              <p>يتم جمع بيانات الاستخدام تلقائيًا عند استخدام الخدمة.</p>
              <p>
                قد تتضمن بيانات الاستخدام معلومات مثل عنوان بروتوكول الإنترنت
                الخاص بجهازك (مثل عنوان IP)، ونوع المتصفح، وإصدار المتصفح،
                وصفحات خدمتنا التي تزورها، ووقت وتاريخ زيارتك، والوقت الذي تقضيه
                في تلك الصفحات، والجهاز الفريد المعرفات والبيانات التشخيصية
                الأخرى.
              </p>
              <p>
                عندما تصل إلى الخدمة عن طريق أو من خلال جهاز محمول، قد نقوم بجمع
                معلومات معينة تلقائيًا، بما في ذلك، على سبيل المثال لا الحصر،
                نوع الجهاز المحمول الذي تستخدمه، والمعرف الفريد لجهازك المحمول،
                وعنوان IP الخاص بجهازك المحمول، وهاتفك المحمول. نظام التشغيل
                ونوع متصفح الإنترنت عبر الهاتف المحمول الذي تستخدمه ومعرفات
                الجهاز الفريدة والبيانات التشخيصية الأخرى.
              </p>
              <p>
                يجوز لنا أيضًا جمع المعلومات التي يرسلها متصفحك عندما تزور
                خدمتنا أو عندما تصل إلى الخدمة عن طريق جهاز محمول أو من خلاله.
              </p>
              <p>تقنيات التتبع وملفات تعريف الارتباط</p>
              <p>
                نحن نستخدم ملفات تعريف الارتباط وتقنيات التتبع المشابهة لتتبع
                النشاط على خدمتنا وتخزين معلومات معينة. تقنيات التتبع المستخدمة
                هي الإشارات والعلامات والبرامج النصية لجمع المعلومات وتتبعها
                ولتحسين خدمتنا وتحليلها. قد تشمل التقنيات التي نستخدمها ما يلي:
              </p>
              <p>
                • ملفات تعريف الارتباط أو ملفات تعريف الارتباط للمتصفح. ملف
                تعريف الارتباط هو ملف صغير يتم وضعه على جهازك. يمكنك توجيه
                متصفحك لرفض جميع ملفات تعريف الارتباط أو الإشارة إلى وقت إرسال
                ملف تعريف الارتباط. ومع ذلك، إذا كنت لا تقبل ملفات تعريف
                الارتباط، فقد لا تتمكن من استخدام بعض أجزاء خدمتنا. ما لم تقم
                بتعديل إعداد المتصفح الخاص بك بحيث يرفض ملفات تعريف الارتباط،
                فقد تستخدم خدمتنا ملفات تعريف الارتباط.
              </p>
              <p>
                • منارات الويب. قد تحتوي أقسام معينة من خدمتنا ورسائل البريد
                الإلكتروني الخاصة بنا على ملفات إلكترونية صغيرة تُعرف باسم
                إشارات الويب (يُشار إليها أيضًا باسم صور GIF الواضحة وعلامات
                البكسل وصور GIF أحادية البكسل) والتي تسمح للشركة، على سبيل
                المثال، بإحصاء المستخدمين الذين قاموا بزيارة تلك الصفحات أو فتح
                بريد إلكتروني للحصول على إحصائيات موقع الويب الأخرى ذات الصلة
                (على سبيل المثال، تسجيل شعبية قسم معين والتحقق من سلامة النظام
                والخادم).
              </p>
              <p>
                يمكن أن تكون ملفات تعريف الارتباط "دائمة" أو "جلسة". تظل ملفات
                تعريف الارتباط الدائمة على جهاز الكمبيوتر الشخصي أو الجهاز
                المحمول الخاص بك عندما تكون غير متصل بالإنترنت، بينما يتم حذف
                ملفات تعريف الارتباط الخاصة بالجلسة بمجرد إغلاق متصفح الويب
                الخاص بك.
              </p>
              <p>
                نحن نستخدم كلاً من ملفات تعريف الارتباط الخاصة بالجلسة والدائمة
                للأغراض المبينة أدناه:
              </p>
              <p>• ملفات تعريف الارتباط الضرورية / الأساسية</p>
              <p>النوع: ملفات تعريف الارتباط للجلسة</p>
              <p>بأدارة : نحن</p>
              <p>
                الغرض: تعد ملفات تعريف الارتباط هذه ضرورية لتزويدك بالخدمات
                المتاحة من خلال الموقع ولتمكينك من استخدام بعض ميزاته. فهي تساعد
                على مصادقة المستخدمين ومنع الاستخدام الاحتيالي لحسابات
                المستخدمين. بدون ملفات تعريف الارتباط هذه، لا يمكن تقديم الخدمات
                التي طلبتها، ونحن نستخدم ملفات تعريف الارتباط هذه فقط لتزويدك
                بهذه الخدمات.
              </p>
              <p>
                • سياسة ملفات تعريف الارتباط / ملفات تعريف الارتباط لقبول
                الإشعارات
              </p>
              <p>النوع: ملفات تعريف الارتباط الدائمة</p>
              <p>بأدارة : نحن</p>
              <p>
                الغرض: تحدد ملفات تعريف الارتباط هذه ما إذا كان المستخدمون قد
                قبلوا استخدام ملفات تعريف الارتباط على موقع الويب.
              </p>
              <p>• ملفات تعريف الارتباط الوظيفية</p>
              <p>النوع: ملفات تعريف الارتباط الدائمة</p>
              <p>بأدارة : نحن</p>
              <p></p>
              <p>
                الغرض: تسمح لنا ملفات تعريف الارتباط هذه بتذكر الاختيارات التي
                تقوم بها عند استخدام موقع الويب، مثل تذكر تفاصيل تسجيل الدخول أو
                تفضيلات اللغة. الغرض من ملفات تعريف الارتباط هذه هو تزويدك
                بتجربة شخصية أكثر وتجنب الاضطرار إلى إعادة إدخال تفضيلاتك في كل
                مرة تستخدم فيها موقع الويب.
              </p>
              <p>
                لمزيد من المعلومات حول ملفات تعريف الارتباط التي نستخدمها
                واختياراتك فيما يتعلق بملفات تعريف الارتباط، يرجى زيارة سياسة
                ملفات تعريف الارتباط الخاصة بنا أو قسم ملفات تعريف الارتباط في
                سياسة الخصوصية الخاصة بنا.
              </p>
              <p>استخدام بياناتك الشخصية</p>
              <p>يجوز للشركة استخدام البيانات الشخصية للأغراض التالية:</p>
              <p>
                • توفير خدمتنا والحفاظ عليها، بما في ذلك مراقبة استخدام خدمتنا.
              </p>
              <p>
                • لإدارة حسابك: لإدارة تسجيلك كمستخدم للخدمة. يمكن أن تمنحك
                البيانات الشخصية التي تقدمها إمكانية الوصول إلى وظائف مختلفة
                للخدمة المتاحة لك كمستخدم مسجل.
              </p>
              <p>
                • لتنفيذ العقد: التطوير والامتثال والتعهد بعقد الشراء للمنتجات
                أو العناصر أو الخدمات التي اشتريتها أو أي عقد آخر معنا من خلال
                الخدمة.
              </p>
              <p>
                • للاتصال بك: للاتصال بك عن طريق البريد الإلكتروني أو المكالمات
                الهاتفية أو الرسائل النصية القصيرة أو أشكال أخرى مماثلة من
                الاتصالات الإلكترونية، مثل الإشعارات الفورية لتطبيقات الهاتف
                المحمول فيما يتعلق بالتحديثات أو الاتصالات الإعلامية المتعلقة
                بالوظائف أو المنتجات أو الخدمات المتعاقد عليها، بما في ذلك
                التحديثات الأمنية. ، عندما يكون ذلك ضروريا أو معقولا لتنفيذها.
              </p>
              <p>
                • لتزويدك بالأخبار والعروض الخاصة والمعلومات العامة حول السلع
                والخدمات والأحداث الأخرى التي نقدمها والمشابهة لتلك التي
                اشتريتها بالفعل أو استفسرت عنها ما لم تكن قد اخترت عدم تلقي هذه
                المعلومات.
              </p>
              <p>• لإدارة طلباتك: لحضور وإدارة طلباتك المقدمة إلينا.</p>
              <p>
                • بالنسبة لعمليات نقل الأعمال: قد نستخدم معلوماتك لتقييم أو
                إجراء عملية دمج أو تصفية أو إعادة هيكلة أو إعادة تنظيم أو حل أو
                بيع أو نقل آخر لبعض أو كل أصولنا، سواء كمنشأة مستمرة أو كجزء من
                الإفلاس أو التصفية. ، أو إجراء مماثل، حيث تكون البيانات الشخصية
                التي نحتفظ بها حول مستخدمي خدمتنا من بين الأصول المنقولة.
              </p>
              <p>
                • لأغراض أخرى: قد نستخدم معلوماتك لأغراض أخرى، مثل تحليل
                البيانات وتحديد اتجاهات الاستخدام وتحديد مدى فعالية حملاتنا
                الترويجية وتقييم وتحسين خدمتنا ومنتجاتنا وخدماتنا والتسويق
                وتجربتك.
              </p>
              <p>قد نشارك معلوماتك الشخصية في الحالات التالية:</p>
              <p>
                • مع مقدمي الخدمة: قد نشارك معلوماتك الشخصية مع مقدمي الخدمة
                لمراقبة وتحليل استخدام خدمتنا، للاتصال بك.
              </p>
              <p>
                • بالنسبة لعمليات نقل الأعمال: يجوز لنا مشاركة معلوماتك الشخصية
                أو نقلها فيما يتعلق أو أثناء المفاوضات بشأن أي اندماج أو بيع
                أصول الشركة أو تمويل أو الاستحواذ على كل أعمالنا أو جزء منها إلى
                شركة أخرى.
              </p>
              <p>
                • مع الشركات التابعة: قد نشارك معلوماتك مع الشركات التابعة لنا،
                وفي هذه الحالة سنطلب من تلك الشركات التابعة احترام سياسة
                الخصوصية هذه. تشمل الشركات التابعة شركتنا الأم وأي شركات فرعية
                أخرى أو شركاء في مشاريع مشتركة أو شركات أخرى نسيطر عليها أو تخضع
                لسيطرة مشتركة معنا.
              </p>
              <p>
                • مع شركاء العمل: قد نشارك معلوماتك مع شركاء العمل لدينا لنقدم
                لك منتجات أو خدمات أو عروض ترويجية معينة.
              </p>
              <p>
                • مع مستخدمين آخرين: عندما تشارك معلومات شخصية أو تتفاعل بطريقة
                أخرى في المناطق العامة مع مستخدمين آخرين، فقد يتم عرض هذه
                المعلومات من قبل جميع المستخدمين وقد يتم توزيعها للعامة في
                الخارج.
              </p>
              <p>
                • بموافقتك: يجوز لنا الكشف عن معلوماتك الشخصية لأي غرض آخر
                بموافقتك.
              </p>
              <p>الاحتفاظ ببياناتك الشخصية</p>
              <p>
                ستحتفظ الشركة ببياناتك الشخصية فقط طالما كان ذلك ضروريًا للأغراض
                المنصوص عليها في سياسة الخصوصية هذه. سنحتفظ ببياناتك الشخصية
                ونستخدمها بالقدر اللازم للامتثال لالتزاماتنا القانونية (على سبيل
                المثال، إذا طُلب منا الاحتفاظ ببياناتك للامتثال للقوانين المعمول
                بها)، وحل النزاعات، وإنفاذ اتفاقياتنا وسياساتنا القانونية.
              </p>
              <p>
                ستحتفظ الشركة أيضًا ببيانات الاستخدام لأغراض التحليل الداخلي.
                يتم الاحتفاظ ببيانات الاستخدام عمومًا لفترة زمنية أقصر، إلا
                عندما يتم استخدام هذه البيانات لتعزيز الأمان أو لتحسين وظائف
                خدمتنا، أو عندما نكون ملزمين قانونًا بالاحتفاظ بهذه البيانات
                لفترات زمنية أطول.
              </p>
              <p>نقل بياناتك الشخصية</p>
              <p>
                تتم معالجة معلوماتك، بما في ذلك البيانات الشخصية، في مكاتب تشغيل
                الشركة وفي أي أماكن أخرى تتواجد فيها الأطراف المشاركة في
                المعالجة. وهذا يعني أنه قد يتم نقل هذه المعلومات إلى - والاحتفاظ
                بها - على أجهزة الكمبيوتر الموجودة خارج ولايتك أو مقاطعتك أو
                بلدك أو أي ولاية قضائية حكومية أخرى حيث قد تختلف قوانين حماية
                البيانات عن تلك الموجودة في ولايتك القضائية.
              </p>
              <p>
                إن موافقتك على سياسة الخصوصية هذه متبوعة بتقديمك لهذه المعلومات
                تمثل موافقتك على هذا النقل.
              </p>
              <p>
                ستتخذ الشركة جميع الخطوات الضرورية بشكل معقول لضمان التعامل مع
                بياناتك بشكل آمن ووفقًا لسياسة الخصوصية هذه ولن يتم نقل بياناتك
                الشخصية إلى منظمة أو دولة ما لم تكن هناك ضوابط كافية مطبقة بما
                في ذلك أمان بياناتك والمعلومات الشخصية الأخرى.
              </p>
              <p>احذف بياناتك الشخصية</p>
              <p>
                لديك الحق في حذف أو طلب المساعدة في حذف البيانات الشخصية التي
                جمعناها عنك.
              </p>
              <p>
                قد تمنحك خدمتنا القدرة على حذف معلومات معينة عنك من داخل الخدمة.
              </p>
              <p>
                يمكنك تحديث معلوماتك أو تعديلها أو حذفها في أي وقت عن طريق تسجيل
                الدخول إلى حسابك، إذا كان لديك حساب، وزيارة قسم إعدادات الحساب
                الذي يسمح لك بإدارة معلوماتك الشخصية. يمكنك أيضًا الاتصال بنا
                لطلب الوصول إلى أو تصحيح أو حذف أي معلومات شخصية قدمتها لنا.
              </p>
              <p>
                ومع ذلك، يرجى ملاحظة أننا قد نحتاج إلى الاحتفاظ بمعلومات معينة
                عندما يكون لدينا التزام قانوني أو أساس قانوني للقيام بذلك.
              </p>
              <p>الكشف عن بياناتك الشخصية</p>
              <p>المعاملات التجارية</p>
              <p>
                إذا كانت الشركة متورطة في عملية دمج أو استحواذ أو بيع أصول، فقد
                يتم نقل بياناتك الشخصية. سنقدم إشعارًا قبل نقل بياناتك الشخصية
                وقبل أن تصبح خاضعة لسياسة خصوصية مختلفة.
              </p>
              <p>تطبيق القانون</p>
              <p>
                في ظل ظروف معينة، قد يُطلب من الشركة الكشف عن بياناتك الشخصية
                إذا كان ذلك مطلوبًا بموجب القانون أو استجابة لطلبات صالحة من
                السلطات العامة (مثل المحكمة أو وكالة حكومية).
              </p>
              <p>المتطلبات القانونية الأخرى</p>
              <p>
                يجوز للشركة الكشف عن بياناتك الشخصية بحسن نية أن هذا الإجراء
                ضروري من أجل:
              </p>
              <p>• الامتثال لالتزام قانوني</p>
              <p>• حماية والدفاع عن حقوق أو ملكية الشركة</p>
              <p>• منع أو التحقيق في أي مخالفات محتملة فيما يتعلق بالخدمة</p>
              <p>• حماية السلامة الشخصية لمستخدمي الخدمة أو الجمهور</p>
              <p>• الحماية من المسؤولية القانونية</p>
              <p></p>
              <p>أمن بياناتك الشخصية</p>
              <p>
                يعد أمان بياناتك الشخصية أمرًا مهمًا بالنسبة لنا، ولكن تذكر أنه
                لا توجد طريقة نقل عبر الإنترنت أو طريقة تخزين إلكترونية آمنة
                بنسبة 100%. بينما نسعى جاهدين لاستخدام وسائل مقبولة تجاريًا
                لحماية بياناتك الشخصية، لا يمكننا ضمان أمانها المطلق.
              </p>
              <p>خصوصية الأطفال</p>
              <p>
                لا تتناول خدمتنا أي شخص يقل عمره عن 13 عامًا. نحن لا نجمع
                معلومات التعريف الشخصية عن قصد من أي شخص يقل عمره عن 13 عامًا.
                إذا كنت أحد الوالدين أو الوصي وكنت على علم بأن طفلك قد زودنا
                ببيانات شخصية، فيرجى اتصل بنا. إذا علمنا أننا قمنا بجمع بيانات
                شخصية من أي شخص يقل عمره عن 13 عامًا دون التحقق من موافقة
                الوالدين، فإننا نتخذ خطوات لإزالة تلك المعلومات من خوادمنا.
              </p>
              <p>
                إذا كنا بحاجة إلى الاعتماد على الموافقة كأساس قانوني لمعالجة
                معلوماتك وكان بلدك يتطلب موافقة أحد الوالدين، فقد نطلب موافقة
                والديك قبل أن نقوم بجمع تلك المعلومات واستخدامها.
              </p>
              <p>روابط لمواقع أخرى</p>
              <p>
                قد تحتوي خدمتنا على روابط لمواقع أخرى لا نقوم بإدارتها. إذا نقرت
                على رابط طرف ثالث، فسيتم توجيهك إلى موقع الطرف الثالث. ننصحك
                بشدة بمراجعة سياسة الخصوصية لكل موقع تزوره.
              </p>
              <p>
                ليس لدينا أي سيطرة ولا نتحمل أي مسؤولية عن المحتوى أو سياسات
                الخصوصية أو الممارسات الخاصة بأي مواقع أو خدمات تابعة لجهات
                خارجية.
              </p>
              <p></p>
              <p>التغييرات على سياسة الخصوصية هذه</p>
              <p>
                قد نقوم بتحديث سياسة الخصوصية الخاصة بنا من وقت لآخر. وسوف نقوم
                بإعلامك بأي تغييرات عن طريق نشر سياسة الخصوصية الجديدة على هذه
                الصفحة.
              </p>
              <p>
                سنخبرك عبر البريد الإلكتروني و/أو إشعار بارز على خدمتنا، قبل أن
                يصبح التغيير ساري المفعول ونقوم بتحديث تاريخ "آخر تحديث" في
                الجزء العلوي من سياسة الخصوصية هذه.
              </p>
              <p>
                ننصحك بمراجعة سياسة الخصوصية هذه بشكل دوري لمعرفة أي تغييرات.
                تصبح التغييرات التي يتم إجراؤها على سياسة الخصوصية هذه فعالة عند
                نشرها على هذه الصفحة.
              </p>
              <p>اتصل بنا</p>
              <p>
                إذا كانت لديك أي أسئلة حول سياسة الخصوصية هذه، يمكنك الاتصال
                بنا:
              </p>
              <p>• عبر البريد الإلكتروني: info@khardl.com</p>
              <p></p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Privacy;
