import React, {useCallback, useState} from "react"
import {
  PiAlignCenterHorizontalLight,
  PiAlignLeftLight,
  PiAlignRightLight,
} from "react-icons/pi"

const alignments = [
  {
    position: "left",
    icon: <PiAlignLeftLight size={25} />,
  },
  {
    position: "center",
    icon: <PiAlignCenterHorizontalLight size={25} />,
  },
  {
    position: "right",
    icon: <PiAlignRightLight size={25} />,
  },
]

const LogoAlignment = () => {
  const [activeAlign, setActiveAlign] = useState("")

  const handleActiveAlign = useCallback((position) => {
    setActiveAlign(position)
  }, [])
  return (
    <div className='flex items-center gap-3 bg-neutral-100 rounded-2xl p-2'>
      {alignments.map((alignment, idx) => (
        <div
          className={` ${
            idx <= 1 ? "border-r border-neutral-300 px-2" : "px-2"
          } ${
            alignment.position === activeAlign ? "bg-white rounded-2xl p-1" : ""
          }`}
          key={idx}
          onClick={() => {
            handleActiveAlign(alignment.position)
          }}
        >
          {alignment.icon}
        </div>
      ))}
    </div>
  )
}

export default LogoAlignment
