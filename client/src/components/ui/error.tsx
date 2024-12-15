import { FieldError, Merge, FieldErrorsImpl } from "react-hook-form";
import { Label } from "./label";

function Error({
  children,
}: {
  children:
    | string
    | FieldError
    | Merge<FieldError, FieldErrorsImpl<any>>
    | undefined;
}) {
  return <Label className="text-red-500">{children?.toString()}</Label>;
}

export default Error;
