import React, {useEffect, useState} from "react"
import profileIcon from "../../../assets/profileIcon.svg"
import PrimaryTextInput from "./PrimaryTextInput"
import AxiosInstance from "../../../axios/axios"
import {toast} from "react-toastify"
import {useTranslation} from "react-i18next"
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard/components/Places"

const CustomerProfile = () => {
  const {t} = useTranslation()
  const [firstName, setFirstName] = useState("")
  const [lastName, setLastName] = useState("")
  const [phone, setPhone] = useState("")
  const [address, setAddress] = useState("")
  const [isLoading, setIsLoading] = useState(false)

  const fetchProfileData = async () => {
    if (isLoading) return
    setIsLoading(true)

    try {
      const profileResponse = await AxiosInstance.get(`user`)

      console.log("profileResponse >>>", profileResponse.data)
      if (profileResponse.data) {
        setFirstName(profileResponse.data?.data?.firstName ?? t("N/A"))
        setLastName(profileResponse.data?.data?.lastName ?? t("N/A"))
        setPhone(profileResponse.data?.data?.phone ?? t("N/A"))
        setAddress(profileResponse.data?.data?.address ?? t("N/A"))
      }
    } catch (error) {
      console.log(error)
    } finally {
      setIsLoading(false)
    }
  }

  useEffect(() => {
    fetchProfileData().then((r) => null)
  }, [])

  const handleSaveProfile = async () => {
    if (window.confirm(t("Are You sure you want to save profile changes?"))) {
      if (isLoading) return
      setIsLoading(true)

      try {
        await AxiosInstance.post(`/user`, {
          address: address,
          first_name: firstName,
          last_name: lastName,
          phone: phone,
          // lat: selected && selected?.lat,
          // lng: selected && selected?.lng,
        })
          .then((r) => {
            toast.success(t("Profile updated successfully"))
          })
          .finally((r) => {
            setIsLoading(false)
          })
      } catch (error) {
        toast.error(error.response.data.message)
      }
    }
  }
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={profileIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>Profile</h3>
      </div>
      <h3 className='text-lg my-5 '>Profile Detail</h3>
      <div className='w-full bg-white shadow-md  min-h-[300px] h-full p-4'>
        <div className='w-1/3 flex flex-col gap-4'>
          <PrimaryTextInput
            id={"first-name"}
            name={"first-name"}
            label={"First Name"}
            placeholder={"First name"}
          />
          <PrimaryTextInput
            id={"last-name"}
            name={"last-name"}
            label={"Last Name"}
            placeholder={"Last name"}
          />
          <PrimaryTextInput
            id={"phone-number"}
            name={"phone-number"}
            type='tel'
            label={"Phone Number"}
            placeholder={"Phone Number"}
          />
        </div>
      </div>
      <h3 className='text-lg my-5 '>Location</h3>
      <div className='w-full bg-white shadow-md  min-h-[400px] h-full p-4'>
        <div className='w-full flex flex-col gap-4'>
          <Places
            inputStyle={
              "input border-[var(--customer)] !w-1/3 hover:border-[var(--customer)] focus-visible:border-[var(--customer)] outline-0 outline-none focus-visible:outline-none w-full"
            }
          />
        </div>
      </div>
    </div>
  )
}

export default CustomerProfile
