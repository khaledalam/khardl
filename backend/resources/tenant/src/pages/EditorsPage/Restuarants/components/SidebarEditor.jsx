import React, {Fragment, useCallback, useState} from "react"
import PrimaryDropDown from "./PrimaryDropDown"
import SectionPanel from "./SectionPanel"
import EditPanel from "./EditPanel"

const btnList = [
  {
    id: "Section",
    name: "Section",
  },
  {
    id: "Edit",
    name: "Edit",
  },
]

const TABS = {
  section: "Section",
  edit: "Edit",
}

const SidebarEditor = () => {
  const [activeTab, setActiveTab] = useState("Section")
  const [dropdownValue, setDropdownValue] = useState("Template 1")

  const handleActiveTab = useCallback((value) => {
    setActiveTab(value)
  }, [])

  const handleChange = useCallback((value) => {
    setDropdownValue(value)
  }, [])

  return (
    <div className='h-full w-full pt-4 px-2'>
      <div className='w-full flex items-center gap-2 border-b border-neutral-300 pb-4'>
        <div className='bg-neutral-100 w-[45%] laptopXL:w-[40%] p-2 rounded-2xl'>
          <PrimaryDropDown
            handleChange={handleChange}
            defaultValue={dropdownValue}
            dropdownList={[
              {
                text: "Template 1",
              },
              {
                text: "Template 2",
              },
              {
                text: "Template 3",
              },
            ]}
          />
        </div>
        <div className='bg-neutral-100 p-2 w-[55%] laptopXL:w-[60%] flex items-center  justify-between  rounded-2xl'>
          {btnList.map((item, idx) => (
            <Fragment key={item.id}>
              <button
                className={`btn w-[42%] h-[30px]  ${
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
      <div className=''>
        {activeTab === TABS.section ? (
          <SectionPanel />
        ) : activeTab === TABS.edit ? (
          <EditPanel />
        ) : (
          <Fragment />
        )}
      </div>
    </div>
  )
}

export default SidebarEditor
