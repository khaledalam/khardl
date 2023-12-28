import React, {useCallback, useState} from "react"
import {
  PiAlignCenterHorizontalLight,
  PiAlignLeftLight,
  PiAlignRightLight,
} from "react-icons/pi"

const LogoAlignment = ({iconSize, widthStyle, defaultValue, onChange}) => {
  const [activeAlign, setActiveAlign] = useState(defaultValue)

  const alignments = [
    {
      position: "left",
      icon: <PiAlignLeftLight size={iconSize ? iconSize : 24} />,
    },
    {
      position: "center",
      icon: <PiAlignCenterHorizontalLight size={iconSize ? iconSize : 24} />,
    },
    {
      position: "right",
      icon: <PiAlignRightLight size={iconSize ? iconSize : 24} />,
    },
  ]

  const handleActiveAlign = useCallback((position) => {
    setActiveAlign(position)
    onChange(position)
  }, [])
  return (
    <div className={`${widthStyle ? widthStyle : ""}`}>
      <div
        className={`flex items-center ${
          widthStyle ? "justify-between" : "gap-3"
        } w-full bg-neutral-100 rounded-2xl p-2`}
      >
        {alignments.map((alignment, idx) => (
          <div
            className={` ${
              idx <= 1 ? "border-r border-neutral-300 px-2" : "px-2"
            } ${
              alignment.position === activeAlign
                ? "bg-white rounded-2xl p-1"
                : ""
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
    </div>
  )
}

export default LogoAlignment
