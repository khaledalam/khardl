import React, {Fragment, useCallback, useEffect, useState} from "react"
import PrimaryDropDown from "./PrimaryDropDown"
import SectionPanel from "./SectionPanel"
import EditPanel from "./EditPanel"
import {useTranslation} from "react-i18next"
import {useDispatch, useSelector} from "react-redux"
import {setTemplate} from "../../../../redux/NewEditor/restuarantEditorSlice"
const SidebarEditor = () => {
  const {t} = useTranslation()
  const dispatch = useDispatch()
  const language = useSelector((state) => state.languageMode.languageMode)
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  const [activeTab, setActiveTab] = useState(t("Section"))

  const handleActiveTab = useCallback((value) => {
    setActiveTab(value)
  }, [])

  const handleChange = useCallback(
    (value) => {
      dispatch(setTemplate(value))
    },
    [dispatch]
  )

  const btnList = [
    {
      id: "Section",
      name: t("Section"),
    },
    {
      id: "General",
      name: t("General"),
    },
  ]

  const TABS = {
    section: t("Section"),
    general: t("General"),
  }

  useEffect(() => {
    if (language !== "ar") {
      setActiveTab(t("Section"))
    }
    setActiveTab(t("Section"))
  }, [language])

  return (
    <div className='h-full w-full flex flex-col pt-4 px-2'>
      <div className='w-full flex items-center gap-2 border-b border-neutral-300 pb-4'>
        <div className='bg-neutral-100 w-[45%] laptopXL:w-[40%] p-2 rounded-2xl'>
          <PrimaryDropDown
            handleChange={handleChange}
            defaultValue={
              restaurantStyle.template === "template-1"
                ? t("Template 1")
             : restaurantStyle.template === "template-2"
                ? t("Template 2")
                : restaurantStyle.template === "template-3"
                ? t("Template 3")
                : " "
            }
            dropdownList={[
              {
                value: "template-1",
                text: t("Template 1"),
              },
              // {
              //   value: "template-2",
              //   text: "Template 2",
              // },
              // {
              //   value: "template-3",
              //   text: "Template 3",
              // },
            ]}
          />
        </div>
        <div className='bg-neutral-100 p-2 w-[55%] laptopXL:w-[60%] flex items-center  justify-between  rounded-2xl'>
          {btnList.map((item, idx) => (
            <Fragment key={item.id}>
              <button
                className={`btn w-[44%] h-[30px]  ${
                  item.name === activeTab
                    ? " bg-white hover:bg-white"
                    : "bg-neutral-100 hover:bg-neutral-100 text-neutral-300"
                }`}
                onClick={() => handleActiveTab(item.name)}
              >
                {item.name}
              </button>
              {idx === 0 && <div className='h-8 w-[2px] bg-neutral-400'></div>}
            </Fragment>
          ))}
        </div>
      </div>
      <div className='flex-1 overflow-y-scroll hide-scroll'>
        {activeTab === TABS.section ? (
          <SectionPanel />
        ) : activeTab === TABS.general ? (
          <EditPanel />
        ) : (
          <Fragment />
        )}
      </div>
    </div>
  )
}

export default SidebarEditor
