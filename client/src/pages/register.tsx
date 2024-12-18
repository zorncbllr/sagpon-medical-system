import { useLayoutEffect } from "react";
import Logo from "../assets/logo";
import RegistrationForm from "../components/registration/registration-form";
import BoxReveal from "../components/ui/box-reveal";
import { Card } from "../components/ui/card";

function Register() {
  useLayoutEffect(() => {
    document.title = "Register";
  }, []);

  return (
    <main className="w-full h-screen bg-white flex flex-col gap-4 items-center justify-center">
      <BoxReveal duration={0.4}>
        <Logo />
      </BoxReveal>

      <BoxReveal duration={0.6}>
        <h1 className="text-4xl font-semibold">Sagpon Health Station</h1>
      </BoxReveal>

      <BoxReveal duration={0.3}>
        <Card className="w-[40rem]">
          <RegistrationForm />
        </Card>
      </BoxReveal>
    </main>
  );
}

export default Register;
