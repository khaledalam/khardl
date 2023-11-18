import React, { useEffect, useState } from 'react'
import { useLocation, useParams } from 'react-router-dom'

export function Taps({ children, contentClassName = '' }) {
   function findActiveTap(a) {
      return a.reduce((accumulator, currentValue, i) => {
         if (currentValue.props.active) {
            return i
         }
         return accumulator
      }, 0)
   }

   function TapValidator(Tap) {
      return Tap.type.displayName === 'Tap' ? true : false
   }

   const [activeTap, setActiveTap] = useState(findActiveTap(children))
   const [template, setTemplate] = useState('')
   const location = useLocation()
   const { branch_id } = useParams()

   useEffect(() => {
      if (location.pathname === `/restaurants/${parseInt(branch_id)}`) {
         setTemplate('restaurants')
      }
   }, [location.pathname])

   return (
      <>
         <div
            className={`flex px-2 justify-evenly items-center gap-4 bg-[var(--secondary)] ${contentClassName}`}
         >
            {children.map((item, i) => {
               return (
                  <div key={i}>
                     {TapValidator(item) && (
                        <Tap
                           key={`Tap-{i}`}
                           currentTap={i}
                           activeTap={activeTap}
                           setActiveTap={setActiveTap}
                        >
                           {item.props.children}
                        </Tap>
                     )}
                     {i !== children.length - 1 &&
                        template === 'restaurants' && (
                           <div className='w-[1px] h-[25px] bg-gray-500'></div>
                        )}
                  </div>
               )
            })}
         </div>
         <div className=''>
            {children.map((item, i) => {
               return (
                  <div className={` ${i === activeTap ? 'visible' : 'hidden'}`}>
                     {item.props.component}
                  </div>
               )
            })}
         </div>
      </>
   )
}

export function Tap({
   children,
   activeTap,
   currentTap,
   setActiveTap,
   contentClassName = '',
}) {
   return (
      <>
         <div
            className={`px-2 cursor-pointer
       text-[18px] max-[600px]:text-[15px] ${
          activeTap === currentTap
             ? `font-bold border-b-[3px] border-b-[var(--primary)]`
             : ''
       }
        py-[5px] select-none ${contentClassName}`}
            onClick={() => setActiveTap(currentTap)}
         >
            {children}
         </div>
      </>
   )
}

Tap.displayName = 'Tap'
