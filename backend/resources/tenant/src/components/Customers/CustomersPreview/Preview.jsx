import React, { useRef } from 'react';
import { useSelector } from 'react-redux';
import Dashboard from './components/Dashboard/Dashboard';
import 'babel-polyfill'

const Preview = () => {
  const divRef = useRef(null);
  const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
  const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);



  return (
    <div ref={divRef} className="w-[100%] bg-[var(--forth)] h-[100%] overflow-y-auto"
      style={{
        fontFamily: `${selectedFontFamily}`,
        fontWeight: `${selectedFontWeight}`
      }}>
      <Dashboard />
    </div>
  );
};

export default Preview;
