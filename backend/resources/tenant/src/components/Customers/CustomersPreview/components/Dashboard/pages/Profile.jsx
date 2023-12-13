import React, {useEffect, useState} from 'react';
import { useTranslation } from 'react-i18next';
import Maps from '../../../../../map';
import AxiosInstance from "../../../../../../axios/axios";

const Profile = () => {
   const { t } = useTranslation();
    const [loading, setLoading] = useState(false);
    const [address, setAddress] = useState(null);

    useEffect(() => {
        fetchProfileData().then(r => null);
    }, []);


    const fetchProfileData = async () => {
        if (loading) return;
        setLoading(true);

        try {
            const profileResponse = await AxiosInstance.get(`user`);

            console.log("profileResponse >>>", profileResponse.data)
            if (profileResponse.data) {
                setAddress(profileResponse.data?.address ?? t('N/A'));
            }

        } catch (error) {
            console.log(error);
        } finally {
            setLoading(false);
        }
    };
   return (
      <div className="w-full bg-[var(--secondary)] py-6 px-4">
         <p className='mb-6 font-bold'>{t("Profile")}</p>
         <div className="p-8 bg-white">
            <div className='w-full bg-white' id="id">
               <div className='w-[100%] my-6 py-4 bg-white drop-shadow-md rounded-md'>
                  <p className='font-bold pb-4 px-6'>
                     {t("Profile Details")}
                  </p>
                  <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]'/>
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

                   <div className='py-4 px-8'>
                      <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]'/>
                       <p className='mb-2 mt-4 mx-2'>{t("Address")}</p>
                        <div className="w-[100%]">
                            <input
                                type="text"
                                value={address}
                                onChange={e => setAddress(e.target.value)}
                                className="text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none"
                                placeholder={`${t("Address")}`}
                            />
                        </div>
                   </div>

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
