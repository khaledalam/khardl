import React, {useCallback, useState} from "react"
import PrimaryDropDown from "./PrimaryDropDown"

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

const SidebarEditor = () => {
  const [active, setActive] = useState("Section")
  const [dropdownValue, setDropdownValue] = useState("Template 1")

  const handleActiveTab = useCallback((value) => {
    setActive(value)
  }, [])

  const handleChange = useCallback((value) => {
    setDropdownValue(value)
  }, [])

  return (
    <div className='h-full w-full pt-4 px-2'>
      <div className='w-full flex items-center gap-2'>
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
        <div className='bg-neutral-100 p-2 w-[55%] laptopXL:w-[60%] flex items-center gap-[0.25rem] rounded-2xl'>
          {btnList.map((item) => (
            <button
              className={`btn w-1/2 h-[30px]  ${
                item.name === active
                  ? " bg-white hover:bg-white"
                  : "bg-neutral-100 hover:bg-neutral-100 text-neutral-300"
              }`}
              key={item.id}
              onClick={() => handleActiveTab(item.name)}
            >
              {item.name}
            </button>
          ))}
        </div>
      </div>
    </div>
  )
}

export default SidebarEditor
