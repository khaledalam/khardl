import { useEffect, useState } from 'react'

const PREFIX = 'khardl-'

function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

export default function useLocalStorage(key, initialValue = null) {
   const prefixedKey = PREFIX + key

   const [value, setValue] = useState(() => {
      const jsonValue = localStorage.getItem(prefixedKey)
      if (isJsonString(jsonValue)) return JSON.parse(jsonValue)

      if (typeof initialValue === 'function') {
         return initialValue()
      } else {
         return initialValue
      }
   })

   useEffect(() => {
      localStorage.setItem(prefixedKey, JSON.stringify(value))
   }, [prefixedKey, value])

   return [value, setValue]
}
