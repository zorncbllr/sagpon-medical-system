import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "../ui/select";
import { Label } from "../ui/label";
import { Input } from "../ui/input";
import Error from "../ui/error";
import { FieldValues, FormState, UseFormRegister } from "react-hook-form";

import useMultiFormStore from "../../store/multiform-store";

export function FirstStep({
  formState: { errors },
  register,
}: {
  formState: FormState<FieldValues>;
  register: UseFormRegister<FieldValues>;
}) {
  return (
    <section className="grid grid-cols-2 gap-x-4 gap-y-2 w-full">
      <div>
        <Label>First Name</Label>
        <Input type="text" {...register("firstName")} />
        {errors.firstName && <Error>{errors.firstname?.message}</Error>}
      </div>
      <div>
        <Label>Middle Name</Label>
        <Input type="text" {...register("middleName")} />
        {errors.middleName && <Error>{errors.middleName?.message}</Error>}
      </div>
      <div>
        <Label>Last Name</Label>
        <Input type="text" {...register("lastName")} />
        {errors.lastName && <Error>{errors.lastName?.message}</Error>}
      </div>
      <div>
        <Label>Address</Label>
        <Input type="text" {...register("address")} />
        {errors.address && <Error>{errors.address?.message}</Error>}
      </div>
    </section>
  );
}

export function SecondStep({
  formState: { errors },
  register,
}: {
  formState: FormState<FieldValues>;
  register: UseFormRegister<FieldValues>;
}) {
  const { setData } = useMultiFormStore();

  return (
    <section className="grid">
      <div className="grid gap-2">
        <div className="flex w-full gap-2">
          <div>
            <Label>Date of Birth</Label>
            <Input type="date" {...register("birthDate")} />
            {errors.birthDate && <Error>{errors.birtDate?.message}</Error>}
          </div>
          <div>
            <Label>Phone Number</Label>
            <Input type="number" {...register("phoneNumber")} />
            {errors.phoneNumber && <Error>{errors.phoneNumber?.message}</Error>}
          </div>
          <div>
            <Label>Emergency Contact</Label>
            <Input type="number" {...register("emergencyContact")} />
            {errors.emergencyContact && (
              <Error>{errors.emergencyContact?.message}</Error>
            )}
          </div>
        </div>

        <div className="grid w-full gap-2">
          <div>
            <Label>Insurance Provider</Label>
            <Input type="text" {...register("insuranceProvider")} />
            {errors.insuranceProvider && (
              <Error>{errors.insuranceProvider?.message}</Error>
            )}
          </div>
          <div>
            <Label>Policy Number</Label>
            <Input type="number" {...register("policyNumber")} />
            {errors.policyNumber && (
              <Error>{errors.policyNumber?.message}</Error>
            )}
          </div>
          <div className="grid">
            <Label>Gender</Label>
            <Select
              onValueChange={(value: "male" | "female" | "other") =>
                setData({ gender: value })
              }
            >
              <SelectTrigger className="w-[180px]">
                <SelectValue placeholder="Gender" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="male">Male</SelectItem>
                <SelectItem value="female">Female</SelectItem>
                <SelectItem value="other">Other</SelectItem>
              </SelectContent>
            </Select>
          </div>
        </div>
      </div>
    </section>
  );
}

export function LastStep({
  formState: { errors },
  register,
}: {
  formState: FormState<FieldValues>;
  register: UseFormRegister<FieldValues>;
}) {
  return (
    <section className="w-full grid gap-2">
      <div>
        <Label>Email Address</Label>
        <Input type="email" {...register("email")} />
        {errors.email && <Error>{errors.email?.message}</Error>}
      </div>
      <div className="w-full">
        <Label>Password</Label>
        <Input type="password" {...register("password")} />
        {errors.password && <Error>{errors.password?.message}</Error>}
      </div>
      <div className="w-full">
        <Label>Confirm Password</Label>
        <Input type="password" {...register("confirmPassword")} />
        {errors.confirmPassword && (
          <Error>{errors.confirmPassword?.message}</Error>
        )}
      </div>
    </section>
  );
}
