import { useForm } from "react-hook-form";
import Error from "../../components/ui/error";
import { Input } from "../../components/ui/input";
import { Label } from "../../components/ui/label";
import { useRegister } from "../../services/user-service";
import { firstStepSchema } from "../../schemas/patient-interfaces";
import { zodResolver } from "@hookform/resolvers/zod";
import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "@radix-ui/react-select";
import useMultiFormStore from "../../store/multiform-store";

function PatientRegistration() {
  const { mutate } = useRegister();
  const { setData } = useMultiFormStore();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm({
    resolver: zodResolver(firstStepSchema),
  });
  return (
    <main className="w-4/6 grid gap-8 ">
      <form action="">
        <section className="grid grid-cols-2 gap-x-4 gap-y-2 w-full">
          <div>
            <Label>First Name</Label>
            <Input type="text" {...register("firstName")} />
            {errors.firstName && <Error>{errors.firstName?.message}</Error>}
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
            <Label>Email Address</Label>
            <Input type="text" {...register("email")} />
            {errors.email && <Error>{errors.email?.message}</Error>}
          </div>
        </section>
        <section className="grid gap-8">
          <div>
            <Label>Address</Label>
            <Input type="text" {...register("address")} />
            {errors.address && <Error>{errors.address?.message}</Error>}
          </div>
          <div className="grid gap-8">
            <div className="flex w-full gap-8">
              <div>
                <Label>Date of Birth</Label>
                <Input type="date" {...register("birthDate")} />
                {errors.birthDate && <Error>{errors.birthDate?.message}</Error>}
              </div>

              <div className="w-full grid grid-cols-2 gap-8">
                <div>
                  <Label>Phone Number</Label>
                  <Input type="number" {...register("phoneNumber")} />
                  {errors.phoneNumber && (
                    <Error>{errors.phoneNumber?.message}</Error>
                  )}
                </div>
                <div>
                  <Label>Emergency Contact</Label>
                  <Input type="number" {...register("emergencyContact")} />
                  {errors.emergencyContact && (
                    <Error>{errors.emergencyContact?.message}</Error>
                  )}
                </div>
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
                {errors.gender && <Error>{errors.gender?.message}</Error>}
              </div>
            </div>
          </div>
        </section>
      </form>
    </main>
  );
}

export default PatientRegistration;
