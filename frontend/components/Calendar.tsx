"use client"

import FullCalendar from "@fullcalendar/react"
import dayGridPlugin from "@fullcalendar/daygrid"
import interactionPlugin from "@fullcalendar/interaction"
import { DateSelectArg, EventContentArg } from "@fullcalendar/core/index.js"
import rrulePlugin from "@fullcalendar/rrule"
import timeGridPlugin from "@fullcalendar/timegrid"
import { useEffect, useState } from "react"

const Calendar = ({apiUrl}: {apiUrl:string}) => {
  const [appointments, setAppointments] = useState([])

  useEffect(() => {
    fetchEvents()
  }, [])

  const fetchEvents = async () => {
    fetch(apiUrl)
      .then((response) => response.json())
      .then((data) => setAppointments(data))
  }

  const handleSelect = async (arg: DateSelectArg) => {
    const name = window.prompt("What is your name?")
    if (name) {
      const data = {
        title: name,
        start: arg.startStr,
        end: arg.endStr,
      }
      try {
        const response = await fetch(apiUrl, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        })
        const json = await response.json()
        if (response.ok) {
          alert(response.statusText)
          fetchEvents()
        } else {
          alert(json.message)
        }
      } catch (error) {
        console.log(error)
      }
    }
    arg.view.calendar.unselect()
  }

  const renderEventContent = (eventInfo: EventContentArg) => {
    return (
      <>
        <i>{eventInfo.timeText}</i>
        <b className="pl-2">{eventInfo.event.title}</b>
      </>
    )
  }

  return (
    <FullCalendar
      plugins={[dayGridPlugin, interactionPlugin, rrulePlugin, timeGridPlugin]}
      initialView="dayGridMonth"
      allDaySlot={false}
      events={appointments}
      selectable={true}
      selectMirror={true}
      select={handleSelect}
      eventContent={renderEventContent}
      headerToolbar={{ right: "dayGridMonth,timeGridWeek,timeGridDay", left: "prev,today,next", center: "title" }}
    />
  )
}

export default Calendar
