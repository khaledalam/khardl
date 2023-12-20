import React, {Fragment, useCallback, useState} from "react"

const CategoryAlign = () => {
  const [activeTab, setActiveTab] = useState("Stack")
  const btnList = [
    {
      id: "Stack",
      name: "Stack",
    },
    {
      id: "Grid",
      name: "Grid",
    },
  ]

  const handleActiveTab = useCallback((value) => {
    setActiveTab(value)
  }, [])

  return (
    <div className='bg-neutral-100 p-2 w-[70%] flex items-center justify-between rounded-2xl'>
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
  )
}

export default CategoryAlign
