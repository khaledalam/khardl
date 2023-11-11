import { useEffect, useState } from 'react'

const PREFIX = 'khardl-'

export default function useLocalStorageStatusCode(key, initialValue) {
   const prefixedKey = PREFIX + key

   const [value, setValue] = useState(() => {
      const jsonValue = localStorage.getItem(prefixedKey)
      
      if (jsonValue != null){
         console.log("TTTTTTTT");
         console.log(jsonValue);
         return parseInt(jsonValue)
      }

      if (typeof initialValue === 'function') {
         return initialValue()
      } else {
         return initialValue
      }
   })

   useEffect(() => {
      localStorage.setItem(prefixedKey, parseInt(value))
   }, [prefixedKey, value])

   return [value, setValue]
}
