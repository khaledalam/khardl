import React, {useEffect, useState} from "react"
import profileIcon from "../../../assets/profileIcon.svg"
import PrimaryTextInput from "./PrimaryTextInput"
import AxiosInstance from "../../../axios/axios"
import {toast} from "react-toastify"
import {useTranslation} from "react-i18next"
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard/components/Places"
import {updateCustomerAddress,updateProfileSaveStatus,} from "../../../redux/NewEditor/customerSlice"
import {useSelector, useDispatch} from "react-redux"
import ConfirmationModal from "../../../components/confirmationModal"
import {useNavigate} from "react-router-dom";

const CustomerProfile = () => {
  const {t} = useTranslation()
  const dispatch = useDispatch()
  const [firstName, setFirstName] = useState("John")
  const [lastName, setLastName] = useState("Doe")
  const [phone, setPhone] = useState("96611111111")
  const address = useSelector((state) => state.customerAPI.address?.addressValue)
  const customerAddress = useSelector((state) => state.customerAPI.address)

  const [isDisabled, setIsDisabled] = useState(true)
  const [isLoading, setIsLoading] = useState(false)
  const [modalOpen, setModalOpen] = useState(false)


    const userProfile =
    JSON.parse(localStorage.getItem("userProfileInfo")) || null

  const fetchProfileData = async () => {
    if (isLoading) return
    setIsLoading(true)

    const userProfileInfo = {}

    try {
      const profileResponse = await AxiosInstance.get(`user`)

      console.log("profileResponse >>>PROFILE", profileResponse.data)
      if (profileResponse.data) {
        setFirstName(profileResponse.data?.data?.firstName ?? t("N/A"))
        userProfileInfo["firstName"] = profileResponse.data?.data?.firstName
        setLastName(profileResponse.data?.data?.lastName ?? t("N/A"))
        userProfileInfo["lastName"] = profileResponse.data?.data?.lastName
        setPhone(profileResponse.data?.data?.phone ?? t("N/A"))
        userProfileInfo["phone"] = profileResponse.data?.data?.phone
        dispatch(
          updateCustomerAddress({
              lat: profileResponse.data?.data?.address?.lat,
              lng: profileResponse.data?.data?.address?.lng,
              addressValue: profileResponse.data?.data?.address?.addressValue ?? t("N/A")})
        )
          userProfileInfo["address"] = profileResponse.data?.data?.address;

        localStorage.setItem("userProfileInfo", JSON.stringify(userProfileInfo))
      }
    } catch (error) {
      console.log(error)
    } finally {
      setIsLoading(false)
    }
  }

  window.addEventListener("beforeunload", () => {
    dispatch(updateProfileSaveStatus(false))
  })

  console.log("userProfile", userProfile)

  useEffect(() => {

      if (userProfile) {

      if (firstName?.trim() === userProfile?.firstName?.trim() &&
        lastName?.trim() === userProfile?.lastName?.trim() &&
        phone?.trim() === userProfile?.phone?.trim() &&
          customerAddress?.addressValue?.trim() === userProfile?.address?.addressValue?.trim() &&
          customerAddress?.lat === userProfile?.address?.lat &&
          customerAddress?.lng === userProfile?.address?.lng
      ) {
        dispatch(updateProfileSaveStatus(true))
        console.log("initial values matches userProfile")
          setIsDisabled(true)
      } else {
        console.log("not a match, values changes")
        setIsDisabled(false)
        dispatch(updateProfileSaveStatus(false))
      }
    }
  }, [customerAddress, firstName, lastName, phone, userProfile])

  useEffect(() => {
    fetchProfileData().then((r) => null)
  }, [])

  const saveProfile = async () => {
    setModalOpen(true);
  };

  const handleSaveProfile = async () => {
    setModalOpen(false);
      if (isLoading) return
      setIsLoading(true)

      try {
        await AxiosInstance.post(`/user`, {
          address: customerAddress && customerAddress?.addressValue,
          first_name: firstName,
          last_name: lastName,
          phone: phone,
          lat: customerAddress && customerAddress?.lat,
          lng: customerAddress && customerAddress?.lng,
        })
          .then((r) => {


            if (r?.data?.data?.should_logout) {
                toast.success(t(r?.data?.message));
                setTimeout(() => {
                    window.location.reload();
                }, 800);

            } else {
                toast.success(t("Profile updated successfully"));
            }
          })
          .finally((r) => {
            setIsLoading(false)
          })
      } catch (error) {
        toast.error(error.response.data.message)
      }
  }

  // useEffect(() => {
  //   if (saveProfileChange) {
  //     handleReset()
  //   }
  // }, [saveProfileChange])


  console.log("isDisabled", isDisabled)
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={profileIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>{t("Profile")}</h3>
      </div>
      <h3 className='text-lg my-5 '>{t("Profile Details")}</h3>
      <div className='w-full bg-white shadow-md  min-h-[300px] h-full p-4'>
        <div className='w-full lg:w-1/3 flex flex-col gap-4'>
          <PrimaryTextInput
            id={"first-name"}
            name={"first-name"}
            label={t("First name")}
            value={firstName}
            placeholder={t("First name")}
            onChange={(e) => setFirstName(e.target.value)}
          />
          <PrimaryTextInput
            id={"last-name"}
            name={"last-name"}
            label={t("Last name")}
            placeholder={t("Last name")}
            value={lastName}
            onChange={(e) => setLastName(e.target.value)}
          />
          <PrimaryTextInput
            id={"phone-number"}
            name={"phone-number"}
            type='tel'
            label={t("Phone")}
            placeholder={t("Phone")}
            value={phone}
            onChange={(e) => setPhone(e.target.value)}
          />
        </div>
      </div>
      <h3 className='text-lg my-5 '>{t("Location")}</h3>
      <div className='w-full bg-white shadow-md  min-h-[400px] h-full p-4 flex'>
        <div className='w-full flex flex-col gap-4'>
          <Places
            inputStyle={
              "input border-[var(--customer)] !w-full lg:!w-1/3 hover:border-[var(--customer)] focus-visible:border-[var(--customer)] outline-0 outline-none focus-visible:outline-none w-full"
            }
          />
        </div>
      </div>
      <div className='flex w-full items-center justify-end mt-10 mb-4'>
        <div className='flex items-center gap-5'>
          <button
            onClick={fetchProfileData}
            className='w-[85px] p-2 !border border-solid border-[var(--customer)] bg-white outline-none rounded-lg'
          >
            {t("Cancel")}
          </button>
          <button
            onClick={saveProfile}
            disabled={isDisabled ||isLoading}
            className='w-[85px] p-2 bg-[var(--customer)] disabled:cursor-not-allowed disabled:bg-neutral-400 outline-none text-white rounded-lg'
          >
            {t("Save")}
          </button>
        </div>
      </div>
      <ConfirmationModal
        isOpen={modalOpen}
        message={t("Are You sure you want to save profile changes?")}
        onClose={() => setModalOpen(false)}
        onConfirm={handleSaveProfile}
      />
    </div>
  )
}

export default CustomerProfile
