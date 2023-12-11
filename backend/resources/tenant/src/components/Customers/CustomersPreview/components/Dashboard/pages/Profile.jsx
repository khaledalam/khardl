import React, {useEffect} from 'react';
import { useTranslation } from 'react-i18next';
import { BiSearch } from 'react-icons/bi';
import Maps from '../../../../../map';

const Profile = () => {
   const { t } = useTranslation();

    useEffect(() => {
        console.log("Profile tab");


    }, []);

   return (
      <div className="w-full bg-[var(--secondary)] py-6 px-4">
         <p className='mb-6 font-bold'>{t("Profile")}</p>
         <div className="p-8 bg-white">
            <div className='w-full bg-white' id="id">
               <div className='w-[100%] my-6 py-4 bg-white drop-shadow-md rounded-md'>
                  <p className='font-bold pb-4 px-6'>
                     {t("Profile Details")}
                  </p>
                  <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]'></div>
                  <div className='py-4 px-8'>
                     <p className='mb-2 mx-2'>{t("First name")}</p>
                     <div className="w-[100%]">
                        <input
                           type="text"
                           className="text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none"
                           placeholder={`${t("First name")}`}
                        />
                     </div>
                      <p className='mb-2 mt-4 mx-2'>{t("Last name")}</p>
                      <div className="w-[100%]">
                          <input
                              type="text"
                              className="text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none"
                              placeholder={`${t("Last name")}`}
                          />
                      </div>
                     <p className='mb-2 mt-4 mx-2'>{t("Phone")}</p>
                     <div className="w-[100%]">
                        <input
                           type="text"
                           className="text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none"
                           placeholder={`${t("Phone")}`}
                        />
                     </div>
                  </div>
               </div>
               <div className='w-[100%] mt-10 py-4 bg-white drop-shadow-md rounded-md'>
                  <p className='font-bold pb-4 px-6'>
                     {t("Location")}
                  </p>
                  <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]'></div>
                  <div className='relative py-4 px-8 w-[100%]'>
                     <Maps />
                  </div>
               </div>
            </div>
         </div>
      </div>
   )
}

export default Profile;
