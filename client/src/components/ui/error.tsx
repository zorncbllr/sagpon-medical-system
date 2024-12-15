import { FieldError, Merge, FieldErrorsImpl } from "react-hook-form";

function Error({
  children,
}: {
  children:
    | string
    | FieldError
    | Merge<FieldError, FieldErrorsImpl<any>>
    | undefined;
}) {
  return <p className="text-red-500 text-sm">{children?.toString()}</p>;
}

export default Error;
