export function classNames(...classes) {
  return classes.filter(Boolean).join(" ");
}

export function isValidPhone(phone){
  if (typeof phone !== 'string') {
    return false;
  }

  if (!/^\d+$/.test(phone)) {
    return false;
  }

  if (phone.length === 9 && phone[0] !== '0') {
    return true;
  } else if (phone.length === 10 && phone[0] === '0') {
    return true;
  }

  return false;
}
