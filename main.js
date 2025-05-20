// Load events from server using AJAX
function loadEvents() {
    const search = document.getElementById('search').value;
    const category = document.getElementById('categoryFilter').value;

    fetch(`events.php?search=${search}&category=${category}`)
        .then(response => response.json())
        .then(data => {
            const list = document.getElementById('eventList');
            list.innerHTML = '';

            if (data.length === 0) {
                list.innerHTML = '<p>No events found.</p>';
                return;
            }

            data.forEach(event => {
                list.innerHTML += `
          <div class="event-card">
            <h3>${event.title}</h3>
            <p><strong>Date:</strong> ${event.date}</p>
            <p><strong>Location:</strong> ${event.location}</p>
            <p><strong>Category:</strong> ${event.category}</p>
            <p>${event.description}</p>
          </div>
        `;
            });
        })
        .catch(error => {
            console.error('Error fetching events:', error);
            document.getElementById('eventList').innerHTML = '<p>Error loading events.</p>';
        });
}

// Attach search/filter listeners
document.getElementById('search').addEventListener('input', loadEvents);
document.getElementById('categoryFilter').addEventListener('change', loadEvents);

// Load on page load
window.onload = loadEvents;
