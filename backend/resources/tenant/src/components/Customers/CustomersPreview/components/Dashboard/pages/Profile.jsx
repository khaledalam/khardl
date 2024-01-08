import React, {useEffect, useState} from "react"
import {useTranslation} from "react-i18next"
import Maps from "../../../../../map"
import AxiosInstance from "../../../../../../axios/axios"
import {toast} from "react-toastify"
import Places from "../../../../CustomersEditor/components/Dashboard/components/Places"
import {useSelector} from "react-redux";

const Profile = () => {
  const {t} = useTranslation()
  const [loading, setLoading] = useState(false)
  const [firstName, setFirstName] = useState("")
  const [lastName, setLastName] = useState("")
  const [phone, setPhone] = useState("")
  const [selected, setSelected] = useState(null)

    const customerAddress = useSelector((state) => state.customerAPI.address)


    useEffect(() => {
    fetchProfileData().then((r) => null)
  }, [])

  const fetchProfileData = async () => {
    if (loading) return
    setLoading(true)

    try {
      const profileResponse = await AxiosInstance.get(`user`)

      console.log("profileResponse >>>", profileResponse.data)
      if (profileResponse.data) {
        setFirstName(profileResponse.data?.data?.firstName ?? t("N/A"))
        setLastName(profileResponse.data?.data?.lastName ?? t("N/A"))
        setPhone(profileResponse.data?.data?.phone ?? t("N/A"))
      }
    } catch (error) {
      console.log(error)
    } finally {
      setLoading(false)
    }
  }

  const handleSaveProfile = async () => {
    if (window.confirm(t("Are You sure you want to save profile changes?"))) {
      if (loading) return
      setLoading(true)

      try {
        await AxiosInstance.post(`/user`, {
          address: customerAddress,
          first_name: firstName,
          last_name: lastName,
          phone: phone,
          lat: selected && selected?.lat,
          lng: selected && selected?.lng,
        })
          .then((r) => {
            toast.success(t("Profile updated successfully"))
          })
          .finally((r) => {
            setLoading(false)
          })
      } catch (error) {
        toast.error(error.response.data.message)
      }
    }
  }

  return (
    <div className='w-full bg-[var(--secondary)] py-6 px-4'>
      <p className='mb-6 font-bold'>{t("Profile")}</p>
      <div className='p-8 bg-white'>
        <div className='w-full bg-white' id='id'>
          <div className='w-[100%] my-6 py-4 bg-white drop-shadow-md rounded-md'>
            <p className='font-bold pb-4 px-6'>{t("Profile Details")}</p>
            <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]' />
            <div className='py-4 px-8'>
              <p className='mb-2 mx-2'>{t("First name")}</p>
              <div className='w-[100%]'>
                <input
                  type='text'
                  value={firstName}
                  onChange={(e) => setFirstName(e.target.value)}
                  className='text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none'
                  placeholder={`${t("First name")}`}
                />
              </div>
              <p className='mb-2 mt-4 mx-2'>{t("Last name")}</p>
              <div className='w-[100%]'>
                <input
                  type='text'
                  value={lastName}
                  onChange={(e) => setLastName(e.target.value)}
                  className='text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none'
                  placeholder={`${t("Last name")}`}
                />
              </div>
              <p className='mb-2 mt-4 mx-2'>{t("Phone")}</p>
              <div className='w-[100%]'>
                <input
                  type='text'
                  value={phone}
                  onChange={(e) => setPhone(e.target.value)}
                  className='text-[14px] bg-[var(--secondary)] w-[100%] py-3 rounded-full px-4 appearance-none'
                  placeholder={`${t("Phone")}`}
                />
              </div>
            </div>
          </div>
          <div className='w-[100%] mt-10 py-4 bg-white drop-shadow-md rounded-md'>
            <p className='font-bold pb-4 px-6'>{t("Location")}</p>

            <div className='py-4 px-8'>
              <div className='mb-6 font-bold w-[100%] h-1 bg-[var(--secondary)]' />
              <p className='mb-2 mt-4 mx-2'>{t("Address")}</p>
              <div className='w-[100%] h-[400px]'>
                <Places
                  inputStyle={
                    "w-full text-[14px] bg-[var(--secondary)]  py-3 rounded-full px-4 appearance-none"
                  }
                />
              </div>
            </div>
          </div>

          <button
            disabled={loading}
            onClick={() => handleSaveProfile()}
            className={
              "text-[15px] text-black p-3 my-4 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"
            }
          >
            <span>{t("Save")}</span>
          </button>
        </div>
      </div>
    </div>
  )
}

export default Profile
