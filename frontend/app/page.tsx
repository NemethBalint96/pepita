import Calendar from "@/components/Calendar"

export default function Home() {
  return <Calendar apiUrl={`${process.env.API_URL}`} />
}
