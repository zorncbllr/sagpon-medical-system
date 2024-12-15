import { ReactElement, useState } from "react";

function useMultistepForm(steps: ReactElement[]) {
  const [index, setIndex] = useState<number>(0);

  const next = () =>
    setIndex((idx) => (idx !== steps.length - 1 ? idx + 1 : idx));
  const prev = () => setIndex((idx) => (idx !== 0 ? idx - 1 : idx));

  console.log(index);

  return {
    isLast: index === steps.length - 1,
    isFirst: index === 0,
    currentStep: steps[index],
    currentIndex: index,
    next,
    prev,
  };
}

export default useMultistepForm;
