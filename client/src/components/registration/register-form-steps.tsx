import { Label } from "@radix-ui/react-label";
import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "@radix-ui/react-select";

import { Input } from "../ui/input";
import Error from "../ui/error";
import { PatientFormData } from "../../schemas/patient-interfaces";
import {
  FieldValues,
  FormState,
  useForm,
  UseFormRegister,
} from "react-hook-form";
import * as z from "zod";
import { zodResolver } from "@hookform/resolvers/zod";
import useMultiFormStore from "../../store/multiform-store";
import { useEffect } from "react";

export function FirstStep({
  formState: { errors },
  register,
}: {
  formState: FormState<FieldValues>;
  register: UseFormRegister<FieldValues>;
}) {
  return (
    <section className="grid grid-cols-2 gap-x-8 w-full">
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
        {errors.address && <Error>{errors.lastName?.message}</Error>}
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
      <div className="grid gap-4">
        <div className="flex w-full gap-4">
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

        <div className="grid w-full">
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
    <form className="w-full">
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
    </form>
  );
}
